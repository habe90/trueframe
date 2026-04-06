<?php

use App\Http\Controllers\HomeController;
use App\Models\User;
use TrueFrame\Http\Request;

$router = app(TrueFrame\Routing\Router::class);

$router->get('/', [HomeController::class, 'index']);

// Auth Routes
$router->get('/login', function() {
    return view('auth.login');
});
$router->post('/login', function(Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    if (!$email || !$password) {
        session()->flash('error', 'Email and password are required.');
        return redirect('/login');
    }

    // Validate credentials against database
    $userData = User::findByEmail($email);

    if (!$userData || !password_verify($password, $userData->password)) {
        session()->flash('error', 'Invalid email or password.');
        return redirect('/login');
    }

    session()->put('user_id', $userData->getKey());
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
$router->post('/register', function(Request $request) {
    $name = $request->input('name');
    $email = $request->input('email');
    $password = $request->input('password');
    $passwordConfirmation = $request->input('password_confirmation');

    if (!$name || !$email || !$password) {
        session()->flash('error', 'All fields are required.');
        return redirect('/register');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        session()->flash('error', 'Please enter a valid email address.');
        return redirect('/register');
    }

    if (strlen($password) < 8) {
        session()->flash('error', 'Password must be at least 8 characters.');
        return redirect('/register');
    }

    if ($password !== $passwordConfirmation) {
        session()->flash('error', 'Passwords do not match.');
        return redirect('/register');
    }

    // Check if user already exists
    $existing = User::findByEmail($email);
    if ($existing) {
        session()->flash('error', 'A user with this email already exists.');
        return redirect('/register');
    }

    // Create user
    try {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);
    } catch (\Throwable $e) {
        session()->flash('error', 'Database not configured. Run migrations first: php trueframe migrate');
        return redirect('/register');
    }

    session()->flash('success', 'Registered successfully! Please log in.');
    return redirect('/login');
});

// Example route with middleware
$router->group(['middleware' => ['auth']], function () use ($router) {
    $router->get('/dashboard', function() {
        return view('home', ['title' => 'Dashboard (Auth Required)']);
    });
});