# TrueFrame

A lightweight, Laravel-like PHP framework.

## Setup Instructions

1.  **Clone the repository (or use composer create-project):**
    ```bash
    composer create-project trueframe/trueframe myapp
    cd myapp
    ```
    (If you cloned directly, then `composer install` first)

2.  **Copy the environment file and generate an application key:**
    ```bash
    cp .env.example .env
    php trueframe key:generate # This is run automatically by composer create-project
    ```

3.  **Configure your database:**
    Open `.env` and set your `DB_DRIVER`, `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASS`.

4.  **Run database migrations:**
    ```bash
    php trueframe migrate
    ```

5.  **(Optional) Install Tailwind CSS UI scaffold:**
    ```bash
    npm install -D tailwindcss postcss autoprefixer
    php trueframe ui:install tailwind
    # Now compile assets (e.g., using a simple build script or watch command)
    # npx tailwindcss -i ./resources/css/app.css -o ./public/build/app.css --watch
    ```

6.  **Start the PHP development server:**
    ```bash
    php -S localhost:8000 -t public
    ```
    Now, open your browser and navigate to `http://localhost:8000`.

## CLI Commands

TrueFrame comes with a `trueframe` CLI tool (similar to Laravel's Artisan).

*   `php trueframe make:controller <Name> [--resource]`
*   `php trueframe make:model <Name> [-m]`
*   `php trueframe make:migration <name>`
*   `php trueframe migrate`
*   `php trueframe migrate:rollback`
*   `php trueframe db:seed`
*   `php trueframe make:seeder <Name>`
*   `php trueframe make:middleware <Name>`
*   `php trueframe make:provider <Name>`
*   `php trueframe make:request <Name>`
*   `php trueframe route:list`
*   `php trueframe cache:clear`
*   `php trueframe key:generate`
*   `php trueframe ui:install tailwind`
*   `php trueframe ai:scaffold <Resource> <fields...> [--crud --api --views]`
*   `php trueframe serve`
*   `php trueframe optimize`

## Adding additional Composer packages

You can install any package from Packagist: