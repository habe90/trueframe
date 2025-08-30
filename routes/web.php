<?php

use App\Controllers\HomeController;
use TrueFrame\Routing\Route;
use TrueFrame\Http\Request;

Route::get('/', [HomeController::class, 'index']);

// Example Auth Routes
Route::get('/login', function() {
    return view('auth.login');
});
Route::post('/login', function(Request $request) {
    // Basic login stub
    // In a real app, you'd validate credentials and retrieve user from DB
    session()->put('user_id', 1); // Simulate login
    session()->flash('success', 'Logged in successfully!');
    return redirect('/');
});
Route::get('/logout', function() {
    session()->forget('user_id');
    session()->flash('success', 'Logged out successfully!');
    return redirect('/');
});

Route::get('/register', function() {
    return view('auth.register');
});
Route::post('/register', function(Request $request) {
    // Basic register stub
    // In a real app, you'd create a user in DB
    session()->flash('success', 'Registered successfully!');
    return redirect('/login');
});

// Example route with middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        return view('home', ['title' => 'Dashboard (Auth Required)']);
    });
});