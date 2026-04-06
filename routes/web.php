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
    $user = new User();
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
    $user = new User();
    $existing = $user->findByEmail($email);
    if ($existing) {
        session()->flash('error', 'A user with this email already exists.');
        return redirect('/register');
    }

    // Create user
    $user->create([
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
    ]);

    session()->flash('success', 'Registered successfully! Please log in.');
    return redirect('/login');
});

// Example route with middleware
$router->group(['middleware' => ['auth']], function () use ($router) {
    $router->get('/dashboard', function() {
        return view('home', ['title' => 'Dashboard (Auth Required)']);
    });
});