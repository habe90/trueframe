<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use TrueFrame\Http\Request;
use TrueFrame\Http\Response;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $products = Product::all();
        return $this->view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return $this->view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return Response
     */
    public function store(ProductRequest $request): Response
    {
        Product::create($request->validated());
        session()->flash('success', 'Product created successfully!');
        return $this->redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $product = Product::find($id);
        if (! $product) {
            session()->flash('error', 'Product not found!');
            return $this->redirect('/products');
        }
        return $this->view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id): Response
    {
        $product = Product::find($id);
        if (! $product) {
            session()->flash('error', 'Product not found!');
            return $this->redirect('/products');
        }
        return $this->view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param int $id
     * @return Response
     */
    public function update(ProductRequest $request, int $id): Response
    {
        $product = Product::find($id);
        if (! $product) {
            session()->flash('error', 'Product not found!');
            return $this->redirect('/products');
        }
        $product->update($request->validated());
        session()->flash('success', 'Product updated successfully!');
        return $this->redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $product = Product::find($id);
        if (! $product) {
            session()->flash('error', 'Product not found!');
            return $this->redirect('/products');
        }
        $product->delete();
        session()->flash('success', 'Product deleted successfully!');
        return $this->redirect('/products');
    }
}