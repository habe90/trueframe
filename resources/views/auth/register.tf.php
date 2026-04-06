@extends('layouts.app')

@section('content')
  <div class="min-h-[calc(100vh-12rem)] flex items-center justify-center px-6 py-16">
    <div class="w-full max-w-md">
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-brand-500 text-white text-xl font-bold shadow-sm mb-4">⚡</div>
        <h1 class="text-2xl font-bold tracking-tight">Create your account</h1>
        <p class="mt-1 text-sm text-surface-500">Start building with TrueFrame in seconds</p>
      </div>

      @if(session()->getFlash('error'))
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm mb-6">
          <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg>
          <span>{{ session()->getFlash('error') }}</span>
        </div>
      @endif
      @if(session()->getFlash('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg text-sm mb-6">
          <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
          <span>{{ session()->getFlash('success') }}</span>
        </div>
      @endif

      <div class="card">
        <form method="POST" action="/register" class="space-y-5">
          @csrf

          <div>
            <label for="name" class="block text-sm font-medium text-surface-700 mb-1.5">Name</label>
            <input type="text" name="name" id="name" class="input" placeholder="Your full name" value="{{ old('name') }}" required autofocus>
            @if(errors('name'))<p class="text-red-500 text-xs mt-1.5">{{ errors('name')[0] }}</p>@endif
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-surface-700 mb-1.5">Email</label>
            <input type="email" name="email" id="email" class="input" placeholder="you@example.com" value="{{ old('email') }}" required>
            @if(errors('email'))<p class="text-red-500 text-xs mt-1.5">{{ errors('email')[0] }}</p>@endif
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-surface-700 mb-1.5">Password</label>
            <input type="password" name="password" id="password" class="input" placeholder="••••••••" required>
            @if(errors('password'))<p class="text-red-500 text-xs mt-1.5">{{ errors('password')[0] }}</p>@endif
          </div>

          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-surface-700 mb-1.5">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="input" placeholder="••••••••" required>
          </div>

          <button type="submit" class="btn-primary w-full py-2.5">Create account</button>
        </form>
      </div>

      <p class="text-center text-sm text-surface-500 mt-6">
        Already have an account? <a href="/login" class="font-medium text-brand-600 hover:text-brand-500 transition-colors">Sign in</a>
      </p>
    </div>
  </div>
@endsection