<?php

namespace App\Console\Commands;

use TrueFrame\Console\Command;

class AiControllerCommand extends Command
{
    protected string $signature = 'ai:controller';
    protected string $description = 'Generate a resource controller with model binding and form request.';

    public function handle(): int
    {
        $name = $this->argument(0);
        if (empty($name)) {
            $this->error('Usage: php trueframe ai:controller <Name> [field:type ...]');
            $this->line('');
            $this->line('Example:');
            $this->info('  php trueframe ai:controller Product title:string price:float');
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
        $this->info("⚡ TrueFrame AI:Controller — Generating {$name}Controller");
        $this->line(str_repeat('─', 50));

        $flags = ['--crud' => true];

        try {
            $this->scaffolder()->scaffold($name, $fields, $flags);
            $this->line('');
            $this->info("✓ {$name}Controller generated with CRUD methods.");
            return 0;
        } catch (\Exception $e) {
            $this->error("Generation failed: " . $e->getMessage());
            return 1;
        }
    }
}
