<?php

namespace App\Http\Requests;

use TrueFrame\Application;
use TrueFrame\Http\Request;
use TrueFrame\Exceptions\ValidationException;
use TrueFrame\Http\Response;

abstract class FormRequest
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected Application $app;

    /**
     * The request instance.
     *
     * @var Request
     */
    protected Request $request;

    /**
     * The validated data.
     *
     * @var array
     */
    protected array $validatedData = [];

    /**
     * Create a new FormRequest instance.
     *
     * @param Application $app
     * @param Request $request
     */
    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules(): array;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validate the request data against the rules.
     *
     * @return array The validated data.
     * @throws ValidationException
     */
    public function validate(): array
    {
        if (!$this->authorize()) {
            throw new ValidationException(
                ['authorization' => ['You are not authorized to make this request.']],
                'Unauthorized.',
                403
            );
        }

        $rules = $this->rules();
        $data = $this->request->all();
        $errors = [];

        foreach ($rules as $field => $fieldRules) {
            $fieldRules = is_string($fieldRules) ? explode('|', $fieldRules) : $fieldRules;
            $value = $data[$field] ?? null;

            foreach ($fieldRules as $rule) {
                $error = $this->applyRule($field, $value, $rule, $data);
                if ($error) {
                    $errors[$field][] = $error;
                    break;
                }
            }

            if (!isset($errors[$field])) {
                $this->validatedData[$field] = $value;
            }
        }

        if (!empty($errors)) {
            throw new ValidationException($errors, 'Validation failed.', 422);
        }

        return $this->validatedData;
    }

    /**
     * Apply a single validation rule.
     *
     * @param string $field
     * @param mixed $value
     * @param string $rule
     * @param array $data
     * @return string|null Error message or null if valid.
     */
    protected function applyRule(string $field, mixed $value, string $rule, array $data): ?string
    {
        $params = [];
        if (str_contains($rule, ':')) {
            [$rule, $paramStr] = explode(':', $rule, 2);
            $params = explode(',', $paramStr);
        }

        return match ($rule) {
            'required' => ($value === null || $value === '') ? "The {$field} field is required." : null,
            'string' => (!is_null($value) && !is_string($value)) ? "The {$field} field must be a string." : null,
            'email' => (!is_null($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) ? "The {$field} field must be a valid email address." : null,
            'min' => (!is_null($value) && strlen((string) $value) < (int) ($params[0] ?? 0)) ? "The {$field} field must be at least {$params[0]} characters." : null,
            'max' => (!is_null($value) && strlen((string) $value) > (int) ($params[0] ?? 0)) ? "The {$field} field must not exceed {$params[0]} characters." : null,
            'confirmed' => ($value !== ($data["{$field}_confirmation"] ?? null)) ? "The {$field} confirmation does not match." : null,
            'numeric' => (!is_null($value) && !is_numeric($value)) ? "The {$field} field must be a number." : null,
            default => null,
        };
    }

    /**
     * Get the validated data.
     *
     * @return array
     */
    public function validated(): array
    {
        return $this->validatedData;
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }
}