<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Implement your authorization logic here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|array<string>>
     */
    public function rules(): array
    {
        return [
            \'title\' => \'required|string\',
            \'price\' => \'required\',
            \'active\' => \'required\',
];
    }
}