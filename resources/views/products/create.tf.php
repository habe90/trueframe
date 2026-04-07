@extends('layouts.app')

@section('content')
  <div class="max-w-xl mx-auto bg-white p-8 border rounded-lg shadow-sm">
    <h1 class="text-3xl font-bold mb-6 text-center">Create New Product</h1>

    @if(session()->getFlash('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session()->getFlash('error') }}</span>
      </div>
    @endif

    <form action="/products" method="POST">
      @csrf

<div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input type="text" name="title" id="title" class="input" value="{{ old('title') }}">
        @if(errors('title'))<p class="text-red-500 text-xs mt-1">{{ errors('title')[0] }}</p>@endif
      </div>
<div class="mb-4">
        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
        <input type="number" step="0.01" name="price" id="price" class="input" value="{{ old('price') }}">
        @if(errors('price'))<p class="text-red-500 text-xs mt-1">{{ errors('price')[0] }}</p>@endif
      </div>
<div class="mb-4">
        <label for="active" class="block text-sm font-medium text-gray-700 mb-1">Active</label>
        <input type="checkbox" name="active" id="active" class="h-4 w-4 text-gray-600 border-gray-300 rounded" {{ old('active') ? 'checked' : '' }}>
        @if(errors('active'))<p class="text-red-500 text-xs mt-1">{{ errors('active')[0] }}</p>@endif
      </div>

      <div class="flex justify-end mt-6">
        <button type="submit" class="btn bg-blue-600 hover:bg-blue-700">Create</button>
        <a href="/products" class="btn bg-gray-600 hover:bg-gray-700 ml-2">Back to List</a>
      </div>
    </form>
  </div>
@endsection