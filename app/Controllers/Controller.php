<?php

namespace App\Controllers;

use TrueFrame\Http\Response;
use TrueFrame\View\View;

abstract class Controller
{
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param string $view
     * @param array $data
     * @return Response
     */
    protected function view(string $view, array $data = []): Response
    {
        return view($view, $data);
    }

    /**
     * Return a new JSON response from the application.
     *
     * @param mixed $data
     * @param int $status
     * @param array $headers
     * @return Response
     */
    protected function json(mixed $data = [], int $status = 200, array $headers = []): Response
    {
        return response()->json($data, $status, $headers);
    }

    /**
     * Redirect the user to another URL.
     *
     * @param string $url
     * @param int $status
     * @param array $headers
     * @return Response
     */
    protected function redirect(string $url, int $status = 302, array $headers = []): Response
    {
        return redirect($url, $status, $headers);
    }
}