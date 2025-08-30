<?php

namespace App\Http\Middleware;

use Closure;
use TrueFrame\Http\Request;
use TrueFrame\Http\Response;
use TrueFrame\Http\Middleware\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // This is a stub for authentication.
        // In a real application, you'd check a user's session, token, etc.
        if (!session()->has('user_id') || !session()->get('user_id')) {
            // If not authenticated, redirect to login page
            session()->flash('error', 'You must be logged in to access this page.');
            return redirect('/login');
        }

        return $next($request);
    }
}