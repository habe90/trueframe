<?php

namespace App\Http\Requests;

use TrueFrame\Application;
use TrueFrame\Http\Request;
use TrueFrame\Exceptions\ValidationException;
use TrueFrame\Http\Response;

abstract class FormRequest
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected Application $app;

    /**
     * The request instance.
     *
     * @var Request
     */
    protected Request $request;

    /**
     * The validated data.
     *
     * @var array
     */
    protected array $validatedData = [];

    /**
     * Create a new FormRequest instance.
     *
     * @param Application $app
     * @param Request $request
     */
    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $

Izvinjavam se još jednom zbog prekida! Nastavimo sa dovršavanjem `FormRequest.php` i ostalih fajlova za `trueframe/trueframe` skeleton.

---

### **2. `trueframe/trueframe` (Project Skeleton) - KONAČNA VERZIJA (nastavak)**

// File: trueframe/trueframe/app/Http/Requests/FormRequest.php