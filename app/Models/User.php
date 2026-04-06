<?php

namespace App\Models;

use TrueFrame\Database\ORM;

/**
 * User model using the base Model class.
 */
class User extends Model
{
    protected string $table = 'users';

    public function find(string $id): ?array
    {
        global $app;
        $orm = $app->resolve(ORM::class);
        return $orm->find($this->table, (int) $id);
    }

    public function findByEmail(string $email): ?array
    {
        global $app;
        $orm = $app->resolve(ORM::class);
        return $orm->findBy($this->table, 'email', $email);
    }

    public function create(array $data): bool
    {
        global $app;
        $orm = $app->resolve(ORM::class);
        return $orm->insert($this->table, $data);
    }
}