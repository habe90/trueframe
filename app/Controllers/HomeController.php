<?php

namespace App\Controllers;

use TrueFrame\Http\Response;

class HomeController extends Controller
{
    /**
     * Show the application's home screen.
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->view('home', ['title' => 'Welcome to TrueFrame']);
    }
}