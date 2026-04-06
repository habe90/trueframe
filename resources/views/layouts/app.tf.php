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
            surface: { 50:'#f8fafc', 100:'#f1f5f9', 200:'#e2e8f0', 800:'#1e293b', 900:'#0f172a', 950:'#020617' }
          }
        }
      }
    }
  </script>
  <style type="text/tailwindcss">
    .btn-primary { @apply inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold rounded-lg bg-brand-500 text-white shadow-sm hover:bg-brand-600 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-brand-400 focus:ring-offset-2; }
    .btn-secondary { @apply inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold rounded-lg bg-surface-900 text-white shadow-sm hover:bg-surface-800 transition-all duration-150; }
    .btn-ghost { @apply inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-surface-800 hover:bg-surface-100 transition-all duration-150; }
    .input { @apply block w-full rounded-lg border border-surface-200 bg-white px-3.5 py-2.5 text-sm text-surface-900 shadow-sm placeholder:text-surface-400 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 transition-all duration-150; }
    .card { @apply rounded-xl border border-surface-200 bg-white p-6 shadow-sm; }
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