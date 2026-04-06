<p align="center">
  <strong>⚡ TrueFrame</strong><br>
  <em>The AI-Powered PHP Framework</em>
</p>

<p align="center">
  <a href="#quick-start">Quick Start</a> •
  <a href="#ai-commands">AI Commands</a> •
  <a href="#why-trueframe">Why TrueFrame?</a> •
  <a href="#documentation">Documentation</a>
</p>

---

## What is TrueFrame?

TrueFrame is a **modern PHP framework** built for developers who want to ship fast without learning a 500-page manual.

It has everything you need — routing, ORM, templating, auth, validation — but with **AI-first scaffolding** that generates production-ready code in seconds.

```bash
# This creates: Model + Migration + Controller + Views + Routes
php trueframe ai:crud Product title:string price:float description:text
php trueframe migrate
php trueframe serve
# Done. Full CRUD at /products in under 10 seconds.
```

## Why TrueFrame?

| | Laravel | TrueFrame |
|---|---------|-----------|
| **Setup to first CRUD** | 15+ minutes | **~10 seconds** |
| **Learning curve** | Steep (facades, contracts, 40+ dirs) | **Flat** (clear structure, minimal concepts) |
| **Generate full CRUD** | Multiple artisan commands + manual wiring | **One command**: `ai:crud` |
| **Generate REST API** | Manual controllers + resources + routes | **One command**: `ai:api` |
| **Auth scaffolding** | Separate package (Breeze/Jetstream) | **Built-in**: `ai:auth` |
| **Project health check** | ❌ | **Built-in**: `ai:analyze` |
| **Template engine** | Blade | **TrueBlade** (compatible syntax, lighter core) |

TrueFrame is **not** "Laravel but smaller." It's a different philosophy:

> **Less boilerplate. More shipping.**

## Quick Start

### Install

```bash
composer create-project trueframe/trueframe myapp
cd myapp
```

### Configure

```bash
cp .env.example .env
php trueframe key:generate
```

Edit `.env` with your database credentials:
```env
DB_DRIVER=mysql
DB_HOST=127.0.0.1
DB_NAME=myapp
DB_USER=root
DB_PASS=
```

### Build Something

```bash
# Generate a full blog in one command
php trueframe ai:crud Post title:string body:text published:boolean

# Run migrations
php trueframe migrate

# Start server
php trueframe serve
```

Open `http://localhost:8000/posts` — your blog CRUD is live.

## AI Commands

TrueFrame's killer feature. Every `ai:` command generates **production-ready** code, not stubs.

### `ai:crud` — Full CRUD in One Command

```bash
php trueframe ai:crud Product title:string price:float category:string
```

Generates:
- ✅ `app/Models/Product.php` — Model with fillable, casts
- ✅ `database/migrations/..._create_products_table.php` — Migration with schema
- ✅ `app/Http/Controllers/ProductController.php` — Full CRUD controller
- ✅ `app/Http/Requests/ProductRequest.php` — Form validation
- ✅ `resources/views/products/` — index, create, edit, show views (TrueBlade)
- ✅ `routes/web.php` — All 7 resource routes appended

### `ai:api` — REST API Endpoint

```bash
php trueframe ai:api Post title:string body:text user_id:unsignedBigInteger
```

Generates model, migration, controller, and API routes (`GET`, `POST`, `PUT`, `DELETE`).

### `ai:auth` — Authentication Scaffolding

```bash
php trueframe ai:auth
```

Generates login/register views, routes, middleware, and User model — ready to use.

### `ai:analyze` — Project Health Check

```bash
php trueframe ai:analyze
```

```
⚡ TrueFrame AI:Analyze — Project Health Report
═══════════════════════════════════════════════════════

  ✓ Passing:
    ✓ .env file exists
    ✓ 3 model(s) found
    ✓ 4 controller(s) found
    ✓ Authentication routes detected
    ✓ Layout template exists

  Health Score: 90% — Looking good!
```

### `ai:controller` — Smart Controller

```bash
php trueframe ai:controller Product title:string price:float
```

Generates a resource controller with all CRUD methods wired up.

## CLI Reference

Beyond AI commands, TrueFrame includes a full CLI toolkit:

```
php trueframe serve                          # Start dev server
php trueframe route:list                     # List all routes
php trueframe migrate                        # Run migrations
php trueframe migrate:rollback               # Rollback last migration
php trueframe db:seed                        # Run seeders
php trueframe cache:clear                    # Clear all caches
php trueframe optimize                       # Optimize for production
php trueframe key:generate                   # Generate APP_KEY
php trueframe ui:install tailwind            # Install Tailwind CSS

php trueframe make:model <Name> [-m]         # Create model (+ migration)
php trueframe make:controller <Name>         # Create controller
php trueframe make:migration <name>          # Create migration
php trueframe make:middleware <Name>          # Create middleware
php trueframe make:request <Name>            # Create form request
php trueframe make:provider <Name>           # Create service provider
php trueframe make:seeder <Name>             # Create seeder
```

## Project Structure

```
myapp/
├── app/
│   ├── Console/Commands/        # Custom CLI commands (ai:crud, ai:api, etc.)
│   ├── Http/
│   │   ├── Controllers/         # HTTP controllers
│   │   ├── Middleware/          # Auth, CSRF, Session middleware
│   │   └── Requests/           # Form request validation
│   ├── Models/                  # Database models
│   └── Providers/               # Service providers
├── bootstrap/                   # Application bootstrap
├── config/                      # Configuration files
├── database/
│   ├── migrations/              # Database migrations
│   └── seeders/                 # Database seeders
├── public/                      # Web root (index.php, assets)
├── resources/views/             # TrueBlade templates (.tf.php)
├── routes/
│   ├── web.php                  # Web routes
│   └── api.php                  # API routes
├── storage/                     # Cache, logs, sessions
├── trueframe                    # CLI entry point
└── composer.json
```

## TrueBlade Templates

TrueBlade is TrueFrame's template engine. Familiar syntax, zero learning curve:

```html
@extends('layouts.app')

@section('content')
  <h1>{{ $title }}</h1>

  @if(count($products) > 0)
    @foreach($products as $product)
      <div>{{ $product->name }} — ${{ $product->price }}</div>
    @endforeach
  @else
    <p>No products yet.</p>
  @endif
@endsection
```

Template files use the `.tf.php` extension and are cached automatically.

## Requirements

- PHP 8.2+
- Composer 2.x
- MySQL/SQLite (for database features)

## License

MIT License. See [LICENSE](LICENSE) for details.

---

<p align="center">
  Built with ⚡ by the TrueFrame team
</p>
