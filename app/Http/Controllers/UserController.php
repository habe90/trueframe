<?php

namespace App\Http\Controllers;

use App\Models\User;
use TrueFrame\Http\Response;

class UserController extends Controller
{
    public function show(string $id): Response
    {
        $user = new User();
        $userData = $user->find($id);

        if ($userData) {
            return $this->view('home', [
                'title' => 'User: ' . $userData['name'],
                'user' => $userData,
            ]);
        }

        return $this->redirect('/', 302);
    }

    public function edit(string $id): Response
    {
        $user = new User();
        $userData = $user->find($id);

        if ($userData) {
            return $this->view('home', [
                'title' => 'Edit User: ' . $userData['name'],
                'user' => $userData,
            ]);
        }

        return $this->redirect('/', 302);
    }
}