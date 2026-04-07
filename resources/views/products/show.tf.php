@extends('layouts.app')

@section('content')
  <div class="max-w-xl mx-auto bg-white p-8 border rounded-lg shadow-sm">
    <h1 class="text-3xl font-bold mb-6 text-center">Product Details</h1>

    <div class="bg-gray-50 p-6 rounded-lg border mb-6">
    <p class="mb-2"><strong>Title:</strong> {{ $Product->title }}</p>
    <p class="mb-2"><strong>Price:</strong> {{ $Product->price }}</p>
    <p class="mb-2"><strong>Active:</strong> {{ $Product->active }}</p>
    </div>

    <div class="flex justify-start">
      <a href="/products/{{ $product->id }}/edit" class="btn bg-yellow-600 hover:bg-yellow-700">Edit</a>
      <form action="/products/{{ $product->id }}" method="POST" class="ml-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn bg-red-600 hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this Product?');">Delete</button>
      </form>
      <a href="/products" class="btn bg-gray-600 hover:bg-gray-700 ml-2">Back to List</a>
    </div>
  </div>
@endsection