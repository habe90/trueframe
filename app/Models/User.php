<?php

namespace App\Models;

class User extends Model
{
    protected ?string $table = 'users';

    protected array $fillable = ['name', 'email', 'password'];

    /**
     * Find a user by email address.
     */
    public static function findByEmail(string $email): ?static
    {
        try {
            $data = static::query()->where('email', '=', $email)->first();
            if ($data) {
                return (new static)->fill($data)->setKey($data[(new static)->getKeyName()]);
            }
        } catch (\Throwable $e) {
            // No database connection — return null gracefully
        }
        return null;
    }
}