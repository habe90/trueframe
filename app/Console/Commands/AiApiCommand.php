<?php

namespace App\Console\Commands;

use TrueFrame\Console\Command;

class AiApiCommand extends Command
{
    protected string $signature = 'ai:api';
    protected string $description = 'Generate a complete REST API resource (model, migration, controller, routes).';

    public function handle(): int
    {
        $name = $this->argument(0);
        if (empty($name)) {
            $this->error('Usage: php trueframe ai:api <ResourceName> [field:type ...]');
            $this->line('');
            $this->line('Example:');
            $this->info('  php trueframe ai:api Post title:string body:text user_id:unsignedBigInteger');
            $this->info('  php trueframe ai:api Comment body:text post_id:unsignedBigInteger');
            return 1;
        }

        $fields = [];
        foreach (array_slice($this->arguments, 1) as $arg) {
            if (is_string($arg) && str_contains($arg, ':')) {
                [$fieldName, $fieldType] = explode(':', $arg, 2);
                $fields[$fieldName] = $fieldType;
            }
        }

        if (empty($fields)) {
            $fields = ['name' => 'string'];
        }

        $this->line('');
        $this->info("⚡ TrueFrame AI:API — Scaffolding REST API for {$name}");
        $this->line(str_repeat('─', 50));

        $flags = ['--api' => true];

        try {
            $this->scaffolder()->scaffold($name, $fields, $flags);
            $this->line('');
            $this->line(str_repeat('─', 50));
            $this->info("✓ {$name} API generated successfully!");
            $this->line('');
            $this->line('  Endpoints:');
            $plural = strtolower($name) . 's';
            $this->line("  GET    /api/{$plural}");
            $this->line("  POST   /api/{$plural}");
            $this->line("  GET    /api/{$plural}/{id}");
            $this->line("  PUT    /api/{$plural}/{id}");
            $this->line("  DELETE /api/{$plural}/{id}");
            $this->line('');
            $this->line('  Next: php trueframe migrate && php trueframe serve');
            return 0;
        } catch (\Exception $e) {
            $this->error("Scaffolding failed: " . $e->getMessage());
            return 1;
        }
    }
}
