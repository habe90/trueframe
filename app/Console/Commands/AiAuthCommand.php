<?php

namespace App\Console\Commands;

use TrueFrame\Console\Command;

class AiAuthCommand extends Command
{
    protected string $signature = 'ai:auth';
    protected string $description = 'Scaffold authentication (login, register, logout, middleware, views).';

    public function handle(): int
    {
        $this->line('');
        $this->info('⚡ TrueFrame AI:Auth — Scaffolding Authentication');
        $this->line(str_repeat('─', 50));

        $basePath = $this->app->basePath();

        // Check if auth views already exist
        if (file_exists("{$basePath}/resources/views/auth/login.tf.php")) {
            $this->warn('Auth scaffolding already detected (views/auth/login.tf.php exists).');
            $this->line('Skipping to avoid overwriting your customizations.');
            $this->info('✓ Authentication is already scaffolded.');
            return 0;
        }

        // 1. Create auth views directory
        $viewDir = "{$basePath}/resources/views/auth";
        if (!is_dir($viewDir)) {
            mkdir($viewDir, 0755, true);
        }

        // 2. Generate login view
        $loginView = $this->generateLoginView();
        file_put_contents("{$viewDir}/login.tf.php", $loginView);
        $this->line('  Created resources/views/auth/login.tf.php');

        // 3. Generate register view
        $registerView = $this->generateRegisterView();
        file_put_contents("{$viewDir}/register.tf.php", $registerView);
        $this->line('  Created resources/views/auth/register.tf.php');

        // 4. Ensure User model exists
        if (!file_exists("{$basePath}/app/Models/User.php")) {
            $this->scaffolder()->scaffold('User', [
                'name' => 'string',
                'email' => 'email',
                'password' => 'string',
            ], []);
            $this->line('  Created App/Models/User.php');
            $this->line('  Created users migration');
        } else {
            $this->line('  User model already exists — skipped');
        }

        // 5. Ensure AuthMiddleware exists
        if (!file_exists("{$basePath}/app/Http/Middleware/AuthMiddleware.php")) {
            $this->line('  Creating AuthMiddleware...');
            $this->generateAuthMiddleware($basePath);
        } else {
            $this->line('  AuthMiddleware already exists — skipped');
        }

        // 6. Check if auth routes exist in web.php
        $webRoutes = file_get_contents("{$basePath}/routes/web.php");
        if (!str_contains($webRoutes, '/login')) {
            $this->appendAuthRoutes($basePath);
            $this->line('  Added auth routes to routes/web.php');
        } else {
            $this->line('  Auth routes already exist in web.php — skipped');
        }

        $this->line('');
        $this->line(str_repeat('─', 50));
        $this->info('✓ Authentication scaffolded successfully!');
        $this->line('');
        $this->line('  Routes added:');
        $this->line('  GET  /login     — Show login form');
        $this->line('  POST /login     — Handle login');
        $this->line('  GET  /register  — Show register form');
        $this->line('  POST /register  — Handle registration');
        $this->line('  GET  /logout    — Logout user');
        $this->line('');
        $this->line('  Next: php trueframe migrate && php trueframe serve');
        return 0;
    }

    protected function generateLoginView(): string
    {
        return <<<'BLADE'
@extends('layouts.app')

@section('content')
  <div class="max-w-md mx-auto bg-white p-8 border rounded-lg shadow-sm">
    <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

    @if(session()->getFlash('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session()->getFlash('error') }}</span>
      </div>
    @endif
    @if(session()->getFlash('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session()->getFlash('success') }}</span>
      </div>
    @endif

    <form method="POST" action="/login">
      @csrf
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
        <input type="email" name="email" id="email" class="input" value="{{ old('email') }}" required autofocus>
      </div>
      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" class="input" required>
      </div>
      <button type="submit" class="btn w-full">Login</button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-6">
      Don't have an account? <a href="/register" class="text-gray-900 hover:underline">Register</a>
    </p>
  </div>
@endsection
BLADE;
    }

    protected function generateRegisterView(): string
    {
        return <<<'BLADE'
@extends('layouts.app')

@section('content')
  <div class="max-w-md mx-auto bg-white p-8 border rounded-lg shadow-sm">
    <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>

    @if(session()->getFlash('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session()->getFlash('error') }}</span>
      </div>
    @endif

    <form method="POST" action="/register">
      @csrf
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="name" id="name" class="input" value="{{ old('name') }}" required autofocus>
      </div>
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
        <input type="email" name="email" id="email" class="input" value="{{ old('email') }}" required>
      </div>
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" class="input" required>
      </div>
      <div class="mb-6">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="input" required>
      </div>
      <button type="submit" class="btn w-full">Register</button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-6">
      Already have an account? <a href="/login" class="text-gray-900 hover:underline">Login</a>
    </p>
  </div>
@endsection
BLADE;
    }

    protected function generateAuthMiddleware(string $basePath): void
    {
        $content = <<<'PHP'
<?php

namespace App\Http\Middleware;

use Closure;
use TrueFrame\Http\Request;
use TrueFrame\Http\Response;
use TrueFrame\Http\Middleware\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user_id') || !session()->get('user_id')) {
            session()->flash('error', 'You must be logged in to access this page.');
            return redirect('/login');
        }

        return $next($request);
    }
}
PHP;
        file_put_contents("{$basePath}/app/Http/Middleware/AuthMiddleware.php", $content);
    }

    protected function appendAuthRoutes(string $basePath): void
    {
        $routes = <<<'PHP'

// --- Authentication Routes (generated by ai:auth) ---
$router->get('/login', function() {
    return view('auth.login');
});
$router->post('/login', function(\TrueFrame\Http\Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    if (!$email || !$password) {
        session()->flash('error', 'Email and password are required.');
        return redirect('/login');
    }

    $user = new \App\Models\User();
    $userData = $user->findByEmail($email);

    if (!$userData || !password_verify($password, $userData['password'])) {
        session()->flash('error', 'Invalid email or password.');
        return redirect('/login');
    }

    session()->put('user_id', $userData['id']);
    session()->flash('success', 'Logged in successfully!');
    return redirect('/');
});
$router->get('/logout', function() {
    session()->forget('user_id');
    session()->flash('success', 'Logged out successfully!');
    return redirect('/');
});
$router->get('/register', function() {
    return view('auth.register');
});
$router->post('/register', function(\TrueFrame\Http\Request $request) {
    $name = $request->input('name');
    $email = $request->input('email');
    $password = $request->input('password');
    $passwordConfirmation = $request->input('password_confirmation');

    if (!$name || !$email || !$password) {
        session()->flash('error', 'All fields are required.');
        return redirect('/register');
    }

    if ($password !== $passwordConfirmation) {
        session()->flash('error', 'Passwords do not match.');
        return redirect('/register');
    }

    $user = new \App\Models\User();
    if ($user->findByEmail($email)) {
        session()->flash('error', 'A user with this email already exists.');
        return redirect('/register');
    }

    $user->create([
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
    ]);

    session()->flash('success', 'Registered successfully! Please log in.');
    return redirect('/login');
});
PHP;
        file_put_contents("{$basePath}/routes/web.php", $routes, FILE_APPEND);
    }
}
