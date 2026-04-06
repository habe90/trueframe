<?php

namespace App\Console\Commands;

use TrueFrame\Console\Command;

class AiCrudCommand extends Command
{
    protected string $signature = 'ai:crud';
    protected string $description = 'Generate a full CRUD resource (model, migration, controller, views, routes) in one command.';

    public function handle(): int
    {
        $name = $this->argument(0);
        if (empty($name)) {
            $this->error('Usage: php trueframe ai:crud <ResourceName> [field:type ...]');
            $this->line('');
            $this->line('Example:');
            $this->info('  php trueframe ai:crud Product title:string price:float description:text');
            $this->info('  php trueframe ai:crud BlogPost title:string body:text published:boolean');
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
            $this->warn('No fields specified. Generating scaffold with default fields.');
            $fields = ['name' => 'string'];
        }

        $this->line('');
        $this->info("⚡ TrueFrame AI:CRUD — Scaffolding {$name}");
        $this->line(str_repeat('─', 50));

        $flags = ['--crud' => true, '--views' => true];

        try {
            $this->scaffolder()->scaffold($name, $fields, $flags);
            $this->line('');
            $this->line(str_repeat('─', 50));
            $this->info("✓ {$name} CRUD generated successfully!");
            $this->line('');
            $this->line('  Next steps:');
            $this->line("  1. php trueframe migrate");
            $this->line("  2. php trueframe serve");
            $this->line("  3. Open http://localhost:8000/" . strtolower($name) . "s");
            return 0;
        } catch (\Exception $e) {
            $this->error("Scaffolding failed: " . $e->getMessage());
            return 1;
        }
    }
}
