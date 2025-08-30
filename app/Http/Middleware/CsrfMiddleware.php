<?php

namespace App\Http\Middleware;

use Closure;
use TrueFrame\Http\Request;
use TrueFrame\Http\Response;
use TrueFrame\Http\Middleware\MiddlewareInterface;
use TrueFrame\Exceptions\ValidationException;

class CsrfMiddleware implements MiddlewareInterface
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     * @throws ValidationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isReading($request) || $this->shouldSkipCsrfProtection($request)) {
            return $next($request);
        }

        $token = $request->input('_token');
        $sessionToken = session()->get('_token');

        if (!$token || $token !== $sessionToken) {
            session()->flash('error', 'CSRF token mismatch.');
            throw new ValidationException(['_token' => ['CSRF token mismatch.']], 'CSRF token mismatch.', 419);
        }

        return $next($request);
    }

    /**
     * Determine if the request has a method that should be read.
     *
     * @param Request $request
     * @return bool
     */
    protected function isReading(Request $request): bool
    {
        return in_array($request->method(), ['HEAD', 'GET', 'OPTIONS']);
    }

    /**
     * Determine if CSRF protection should be skipped for the request.
     *
     * @param Request $request
     * @return bool
     */
    protected function shouldSkipCsrfProtection(Request $request): bool
    {
        // Define paths that should be excluded from CSRF verification
        $except = [
            '/api/*', // Example: all API routes
        ];

        foreach ($except as $pattern) {
            if (str_ends_with($pattern, '*')) {
                $pattern = rtrim($pattern, '*');
                if (str_starts_with($request->path(), $pattern)) {
                    return true;
                }
            } elseif ($request->path() === $pattern) {
                return true;
            }
        }

        return false;
    }
}