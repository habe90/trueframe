@extends('layouts.app')

@section('content')
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Product List</h1>
    <a href="/products/create" class="btn bg-blue-600 hover:bg-blue-700">Create New Product</a>
  </div>

  @if(session()->getFlash('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
      <span class="block sm:inline">{{ session()->getFlash('success') }}</span>
    </div>
  @endif

  @if(session()->getFlash('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
      <span class="block sm:inline">{{ session()->getFlash('error') }}</span>
    </div>
  @endif

  <div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full bg-white">
      <thead>
        <tr>
          <th class="px-4 py-2 text-left">Title</th>
          <th class="px-4 py-2 text-left">Price</th>
          <th class="px-4 py-2 text-left">Active</th>
          <th class="px-4 py-2 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $productsItem)
          <tr>
          <td class="border px-4 py-2">{{ $productsItem->title }}</td>
          <td class="border px-4 py-2">{{ $productsItem->price }}</td>
          <td class="border px-4 py-2">{{ $productsItem->active }}</td>
          <td class="border px-4 py-2">
            <a href="/products/{{ $productsItem->id }}" class="text-blue-600 hover:underline">Show</a> |
            <a href="/products/{{ $productsItem->id }}/edit" class="text-yellow-600 hover:underline">Edit</a>
          </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection