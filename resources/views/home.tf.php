@extends('layouts.app')

@section('content')
  <!-- Hero -->
  <section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-brand-50 via-white to-surface-50"></div>
    <div class="relative max-w-6xl mx-auto px-6 pt-20 pb-24 text-center">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 text-brand-700 text-xs font-semibold mb-6 tracking-wide uppercase">
        v0.2 &mdash; AI-Powered
      </div>
      <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-surface-950 leading-[1.1]">
        Build faster.<br class="hidden sm:block"> Ship with less boilerplate.
      </h1>
      <p class="mt-6 text-lg sm:text-xl text-surface-500 max-w-2xl mx-auto leading-relaxed">
        TrueFrame is the PHP framework that generates your CRUD, APIs, and auth scaffolding with a single command. Less config, more code.
      </p>
      <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-3">
        <a href="https://github.com/habe90/trueframe" target="_blank" rel="noopener" class="btn-primary text-base px-7 py-3">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
          Get Started
        </a>
        <span class="btn-ghost bg-surface-900 text-surface-100 font-mono text-sm px-5 py-3 rounded-lg select-all cursor-text">
          composer create-project trueframe/trueframe
        </span>
      </div>
    </div>
  </section>

  <!-- Features -->
  <section class="max-w-6xl mx-auto px-6 py-20">
    <div class="text-center mb-14">
      <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">Everything you need, nothing you don't</h2>
      <p class="mt-3 text-surface-500 max-w-xl mx-auto">One framework. Zero bloat. AI-assisted scaffolding built into the core.</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="card group hover:shadow-md hover:border-brand-200 transition-all duration-200">
        <div class="w-10 h-10 rounded-lg bg-brand-100 text-brand-600 flex items-center justify-center text-lg mb-4 group-hover:bg-brand-500 group-hover:text-white transition-colors">⚡</div>
        <h3 class="font-semibold text-base mb-2">AI Scaffolding</h3>
        <p class="text-sm text-surface-500 leading-relaxed">Generate models, migrations, controllers, views, and routes in a single command. No stubs to memorize.</p>
      </div>
      <div class="card group hover:shadow-md hover:border-brand-200 transition-all duration-200">
        <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg mb-4 group-hover:bg-emerald-500 group-hover:text-white transition-colors">🛡️</div>
        <h3 class="font-semibold text-base mb-2">Auth in One Command</h3>
        <p class="text-sm text-surface-500 leading-relaxed">Login, register, logout, middleware, and views — scaffolded instantly with <code class="text-xs bg-surface-100 px-1.5 py-0.5 rounded">ai:auth</code>.</p>
      </div>
      <div class="card group hover:shadow-md hover:border-brand-200 transition-all duration-200">
        <div class="w-10 h-10 rounded-lg bg-violet-100 text-violet-600 flex items-center justify-center text-lg mb-4 group-hover:bg-violet-500 group-hover:text-white transition-colors">🧩</div>
        <h3 class="font-semibold text-base mb-2">DI Container</h3>
        <p class="text-sm text-surface-500 leading-relaxed">Auto-resolving dependency injection, service providers, and singleton bindings. Clean architecture out of the box.</p>
      </div>
      <div class="card group hover:shadow-md hover:border-brand-200 transition-all duration-200">
        <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center text-lg mb-4 group-hover:bg-amber-500 group-hover:text-white transition-colors">🗄️</div>
        <h3 class="font-semibold text-base mb-2">ORM &amp; Migrations</h3>
        <p class="text-sm text-surface-500 leading-relaxed">ActiveRecord models with query builder, relationships, and versioned migrations. No doctrine, no XML.</p>
      </div>
      <div class="card group hover:shadow-md hover:border-brand-200 transition-all duration-200">
        <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center text-lg mb-4 group-hover:bg-rose-500 group-hover:text-white transition-colors">🎨</div>
        <h3 class="font-semibold text-base mb-2">TrueBlade Templates</h3>
        <p class="text-sm text-surface-500 leading-relaxed">Familiar directive syntax: <code class="text-xs bg-surface-100 px-1.5 py-0.5 rounded">@if</code>, <code class="text-xs bg-surface-100 px-1.5 py-0.5 rounded">@foreach</code>, <code class="text-xs bg-surface-100 px-1.5 py-0.5 rounded">@extends</code>. Compiled and cached.</p>
      </div>
      <div class="card group hover:shadow-md hover:border-brand-200 transition-all duration-200">
        <div class="w-10 h-10 rounded-lg bg-cyan-100 text-cyan-600 flex items-center justify-center text-lg mb-4 group-hover:bg-cyan-500 group-hover:text-white transition-colors">🔌</div>
        <h3 class="font-semibold text-base mb-2">REST API Ready</h3>
        <p class="text-sm text-surface-500 leading-relaxed">Dedicated API routes, JSON responses, and full API resource generation with <code class="text-xs bg-surface-100 px-1.5 py-0.5 rounded">ai:api</code>.</p>
      </div>
    </div>
  </section>

  <!-- Quick Start -->
  <section class="bg-surface-900 text-white">
    <div class="max-w-6xl mx-auto px-6 py-20">
      <div class="text-center mb-12">
        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">Up and running in 60 seconds</h2>
        <p class="mt-3 text-surface-400 max-w-lg mx-auto">Three commands. That's it.</p>
      </div>
      <div class="max-w-2xl mx-auto space-y-4">
        <div class="rounded-xl bg-surface-800 border border-surface-700 overflow-hidden">
          <div class="flex items-center gap-2 px-4 py-2.5 border-b border-surface-700">
            <span class="w-3 h-3 rounded-full bg-red-500/80"></span>
            <span class="w-3 h-3 rounded-full bg-yellow-500/80"></span>
            <span class="w-3 h-3 rounded-full bg-green-500/80"></span>
            <span class="ml-2 text-xs text-surface-500 font-mono">terminal</span>
          </div>
          <div class="p-5 font-mono text-sm space-y-3">
            <div>
              <span class="text-green-400">$</span>
              <span class="text-surface-300 ml-2">composer create-project trueframe/trueframe myapp</span>
            </div>
            <div>
              <span class="text-green-400">$</span>
              <span class="text-surface-300 ml-2">cd myapp</span>
            </div>
            <div>
              <span class="text-green-400">$</span>
              <span class="text-surface-300 ml-2">php trueframe ai:crud Post title:string body:text published:boolean</span>
            </div>
            <div class="text-brand-400 text-xs mt-1">
              ✓ Model created &nbsp;✓ Migration created &nbsp;✓ Controller created &nbsp;✓ Views created &nbsp;✓ Routes added
            </div>
            <div>
              <span class="text-green-400">$</span>
              <span class="text-surface-300 ml-2">php trueframe serve</span>
            </div>
            <div class="text-surface-500 text-xs">→ http://localhost:8000</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="max-w-6xl mx-auto px-6 py-20 text-center">
    <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">Ready to build something?</h2>
    <p class="mt-3 text-surface-500 max-w-lg mx-auto">TrueFrame is open-source, lightweight, and built for developers who value simplicity.</p>
    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
      <a href="https://github.com/habe90/trueframe" target="_blank" rel="noopener" class="btn-primary text-base px-7 py-3">View on GitHub</a>
      <a href="https://packagist.org/packages/trueframe/trueframe" target="_blank" rel="noopener" class="btn-ghost text-base px-7 py-3 border border-surface-200">Packagist</a>
    </div>
  </section>
@endsection