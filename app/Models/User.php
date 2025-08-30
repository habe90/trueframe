<?php

namespace App\Models;

use TrueFrame\Database\ORM;
use TrueFrame\Application;

/**
 * A simple example model using the basic ORM.
 * In a real application, this would extend a base Model class provided by the ORM.
 */
class User
{
    protected ORM $orm;
    protected string $table = 'users';

    public function __construct()
    {
        // Resolve the application instance from the global helper or container
        // This is a common pattern, but direct dependency injection is preferred where possible
        global $app;
        $this->orm = $app->resolve(ORM::class);
    }

    public function find(string $id): ?array
    {
        return $this->orm->find($this->table, (int) $id);
    }

    // Add other CRUD methods here
}