<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function show(string $id): void
    {
        $user = new User(); // In a real app, this would use a repository or service layer
        $userData = $user->find($id); // Assuming a basic find method on a User model

        if ($userData) {
            echo "Viewing user: " . htmlspecialchars($userData['name']) . " with ID: " . htmlspecialchars($id);
        } else {
            echo "User with ID: " . htmlspecialchars($id) . " not found.";
        }
    }

    public function edit(string $id): void
    {
        echo "Editing user with ID: " . htmlspecialchars($id);
    }
}