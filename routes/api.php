<?php

use TrueFrame\Routing\Route;
use TrueFrame\Http\Response;

// Example API route
Route::get('/status', function(TrueFrame\Http\Request $request) {
    return response()->json(['status' => 'ok', 'message' => 'API is running!']);
});

// Example protected API route (if AuthMiddleware was adapted for API tokens)
Route::get('/user', function(TrueFrame\Http\Request $request) {
    // This would typically return authenticated user data
    return response()->json(['id' => session()->get('user_id'), 'name' => 'Test User']);
})->middleware(['auth']); // Apply auth middleware