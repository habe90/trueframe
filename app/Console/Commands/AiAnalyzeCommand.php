<?php

namespace App\Console\Commands;

use TrueFrame\Console\Command;

class AiAnalyzeCommand extends Command
{
    protected string $signature = 'ai:analyze';
    protected string $description = 'Analyze the project structure and report health, missing files, and suggestions.';

    public function handle(): int
    {
        $basePath = $this->app->basePath();

        $this->line('');
        $this->info('⚡ TrueFrame AI:Analyze — Project Health Report');
        $this->line(str_repeat('═', 55));

        $issues = [];
        $ok = [];

        // Check .env
        if (file_exists("{$basePath}/.env")) {
            $ok[] = '.env file exists';
        } else {
            $issues[] = 'No .env file found — run: cp .env.example .env';
        }

        // Check APP_KEY
        if (file_exists("{$basePath}/.env")) {
            $env = file_get_contents("{$basePath}/.env");
            if (str_contains($env, 'APP_KEY=') && !str_contains($env, 'APP_KEY=\n') && !str_contains($env, "APP_KEY=\r")) {
                $ok[] = 'APP_KEY is set';
            } else {
                $issues[] = 'APP_KEY is empty — run: php trueframe key:generate';
            }
        }

        // Check models
        $models = glob("{$basePath}/app/Models/*.php");
        $modelCount = count(array_filter($models, fn($f) => basename($f) !== 'Model.php'));
        if ($modelCount > 0) {
            $ok[] = "{$modelCount} model(s) found";
        } else {
            $issues[] = 'No models found — try: php trueframe ai:crud Product title:string price:float';
        }

        // Check controllers
        $controllers = glob("{$basePath}/app/Http/Controllers/*.php");
        $controllerCount = count(array_filter($controllers, fn($f) => basename($f) !== 'Controller.php'));
        if ($controllerCount > 0) {
            $ok[] = "{$controllerCount} controller(s) found";
        } else {
            $issues[] = 'No controllers found — try: php trueframe ai:controller Product';
        }

        // Check migrations
        $migrations = glob("{$basePath}/database/migrations/*.php");
        if (count($migrations) > 0) {
            $ok[] = count($migrations) . ' migration(s) found';
        } else {
            $issues[] = 'No migrations found';
        }

        // Check views
        $views = glob("{$basePath}/resources/views/**/*.tf.php");
        $rootViews = glob("{$basePath}/resources/views/*.tf.php");
        $totalViews = count($views) + count($rootViews);
        if ($totalViews > 0) {
            $ok[] = "{$totalViews} TrueBlade view(s) found";
        } else {
            $issues[] = 'No .tf.php views found';
        }

        // Check routes
        $webRoutes = file_get_contents("{$basePath}/routes/web.php");
        $routeMatches = substr_count($webRoutes, '$router->get') + substr_count($webRoutes, '$router->post');
        if ($routeMatches > 0) {
            $ok[] = "~{$routeMatches} web route(s) defined";
        }

        // Check auth
        if (str_contains($webRoutes, '/login')) {
            $ok[] = 'Authentication routes detected';
        } else {
            $issues[] = 'No auth routes — try: php trueframe ai:auth';
        }

        // Check middleware
        if (file_exists("{$basePath}/app/Http/Middleware/AuthMiddleware.php")) {
            $ok[] = 'Auth middleware exists';
        }
        if (file_exists("{$basePath}/app/Http/Middleware/CsrfMiddleware.php")) {
            $ok[] = 'CSRF middleware exists';
        }

        // Check layout
        if (file_exists("{$basePath}/resources/views/layouts/app.tf.php")) {
            $ok[] = 'Layout template exists';
        } else {
            $issues[] = 'No layout template — try: php trueframe ui:install tailwind';
        }

        // Check storage directories
        $storageDirs = ['cache', 'logs', 'sessions', 'views'];
        foreach ($storageDirs as $dir) {
            if (!is_dir("{$basePath}/storage/{$dir}")) {
                $issues[] = "Missing storage/{$dir} directory";
            }
        }

        // Report
        $this->line('');
        if (!empty($ok)) {
            $this->info('  ✓ Passing:');
            foreach ($ok as $item) {
                $this->line("    ✓ {$item}");
            }
        }

        if (!empty($issues)) {
            $this->line('');
            $this->warn('  ✗ Issues:');
            foreach ($issues as $item) {
                $this->line("    ✗ {$item}");
            }
        }

        $this->line('');
        $this->line(str_repeat('═', 55));
        $total = count($ok) + count($issues);
        $score = $total > 0 ? round((count($ok) / $total) * 100) : 0;

        if ($score >= 80) {
            $this->info("  Health Score: {$score}% — Looking good!");
        } elseif ($score >= 50) {
            $this->warn("  Health Score: {$score}% — Needs attention");
        } else {
            $this->error("  Health Score: {$score}% — Needs setup");
        }
        $this->line('');

        return count($issues) === 0 ? 0 : 1;
    }
}
