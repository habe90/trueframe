<?php

namespace Database\Seeders;

class DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Example:
        // $this->call(UserSeeder::class);
    }

    /**
     * Call another seeder.
     *
     * @param string $seederClass
     * @return void
     */
    protected function call(string $seederClass): void
    {
        if (class_exists($seederClass)) {
            (new $seederClass())->run();
        } else {
            // Log or throw an error if seeder not found
            // For now, let's just ignore
        }
    }
}