<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $store = auth()->user()->store;
        $products = $store->products()->paginate(10);
        
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $store = auth()->user()->store;
        $product = $store->products()->create($data);
        $product->categories()->sync($data['categories']);

        flash('Produto criado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($product)
    {
        $categories = \App\Category::all(['id', 'name']);
        $product = $this->product->findOrFail($product);
        $store = \App\Store::find($product->store_id);

        if($store->user_id !== auth()->user()->id)
        {
            flash('Esse produto não pertence a sua loja!')->error();
            return redirect()->route('admin.products.index');
        }

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();
        
        $product = $this->product->find($product);
        $product->update($data);
        $product->categories()->sync($data['categories']);

        flash('Produto atualizado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    public function destroy($product)
    {
        $product = $this->product->findOrFail($product);
        $store = \App\Store::find($product->store_id);

        if($store->user_id !== auth()->user()->id)
        {
            flash('Esse produto não pertence a sua loja!')->error();
            return redirect()->route('admin.products.index');
        }

        $product->delete();
        
        flash('Produto removido com sucesso')->success();
        return redirect()->route('admin.products.index');
    }
}
