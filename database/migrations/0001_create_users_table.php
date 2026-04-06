<?php

use TrueFrame\Database\Migrations\Migration;
use TrueFrame\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        $this->schema->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        $this->schema->dropIfExists('users');
    }
};
