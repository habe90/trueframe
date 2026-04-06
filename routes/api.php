<?php

use TrueFrame\Routing\Route;
use TrueFrame\Http\Response;

// Example API route
Route::get('/status', function(TrueFrame\Http\Request $request) {
    return response()->json(['status' => 'ok', 'message' => 'API is running!']);
});

// Protected API route
// TODO: Replace session-based auth with token-based auth (e.g., Bearer tokens)
// for proper stateless API authentication.
Route::get('/user', function(TrueFrame\Http\Request $request) {
    $userId = session()->get('user_id');
    if (!$userId) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    $user = new \App\Models\User();
    $userData = $user->find((string) $userId);

    if (!$userData) {
        return response()->json(['error' => 'User not found.'], 404);
    }

    // Don't expose password hash in API response
    unset($userData['password']);

    return response()->json($userData);
})->middleware(['auth']);