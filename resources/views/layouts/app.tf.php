<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <title>TrueFrame — AI-Powered PHP Framework</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: { 50:'#f0f7ff', 100:'#e0effe', 200:'#b9dffe', 400:'#4db0fd', 500:'#1a91f0', 600:'#0b74d1', 700:'#095baa' },
            surface: { 50:'#f8fafc', 100:'#f1f5f9', 200:'#e2e8f0', 400:'#94a3b8', 500:'#64748b', 800:'#1e293b', 900:'#0f172a', 950:'#020617' }
          }
        }
      }
    }
  </script>
  <style>
    .btn-primary {
      display: inline-flex; align-items: center; justify-content: center;
      padding: 0.625rem 1.25rem; font-size: 0.875rem; font-weight: 600;
      border-radius: 0.5rem; background-color: #1a91f0; color: #fff;
      box-shadow: 0 1px 2px rgba(0,0,0,.05); transition: all 150ms;
    }
    .btn-primary:hover { background-color: #0b74d1; }
    .btn-primary:focus { outline: none; box-shadow: 0 0 0 2px #fff, 0 0 0 4px #4db0fd; }
    .btn-secondary {
      display: inline-flex; align-items: center; justify-content: center;
      padding: 0.625rem 1.25rem; font-size: 0.875rem; font-weight: 600;
      border-radius: 0.5rem; background-color: #0f172a; color: #fff;
      box-shadow: 0 1px 2px rgba(0,0,0,.05); transition: all 150ms;
    }
    .btn-secondary:hover { background-color: #1e293b; }
    .btn-ghost {
      display: inline-flex; align-items: center; justify-content: center;
      padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500;
      border-radius: 0.5rem; color: #1e293b; transition: all 150ms;
    }
    .btn-ghost:hover { background-color: #f1f5f9; }
    .input {
      display: block; width: 100%; border-radius: 0.5rem;
      border: 1px solid #e2e8f0; background-color: #fff;
      padding: 0.625rem 0.875rem; font-size: 0.875rem; color: #0f172a;
      box-shadow: 0 1px 2px rgba(0,0,0,.05); transition: all 150ms;
    }
    .input::placeholder { color: #94a3b8; }
    .input:focus { border-color: #1a91f0; outline: none; box-shadow: 0 0 0 3px #b9dffe; }
    .card {
      border-radius: 0.75rem; border: 1px solid #e2e8f0;
      background-color: #fff; padding: 1.5rem;
      box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
  </style>
</head>
<body class="bg-surface-50 text-surface-900 antialiased min-h-screen flex flex-col">
  <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-surface-200">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
      <a href="/" class="flex items-center gap-2 group">
        <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-brand-500 text-white text-sm font-bold shadow-sm group-hover:shadow-md transition-shadow">⚡</span>
        <span class="font-bold text-lg tracking-tight">TrueFrame</span>
      </a>
      <div class="flex items-center gap-1">
        <a href="/" class="btn-ghost">Home</a>
        <a href="/login" class="btn-ghost">Login</a>
        <a href="/register" class="btn-primary">Get Started</a>
      </div>
    </div>
  </nav>

  <main class="flex-1">
    @yield('content')
  </main>

  <footer class="border-t border-surface-200 bg-white">
    <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-surface-500">
      <span>&copy; {{ date('Y') }} TrueFrame. Built for developers who ship.</span>
      <div class="flex items-center gap-4">
        <a href="https://github.com/habe90/trueframe" class="hover:text-surface-900 transition-colors" target="_blank" rel="noopener">GitHub</a>
        <a href="https://packagist.org/packages/trueframe/trueframe" class="hover:text-surface-900 transition-colors" target="_blank" rel="noopener">Packagist</a>
      </div>
    </div>
  </footer>
</body>
</html>