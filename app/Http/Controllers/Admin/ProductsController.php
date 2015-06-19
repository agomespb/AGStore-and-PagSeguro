<?php

namespace AGStore\Http\Controllers\Admin;

use AGStore\Http\Controllers\Controller;
use AGStore\Http\Requests;
use AGStore\Repositories\Contracts\CategoryRepositoryInterface;
use AGStore\Repositories\Contracts\ProductRepositoryInterface;

class ProductsController extends Controller
{
    protected $product;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->product = $productRepositoryInterface;
    }

    public function index()
    {
        $produtos = $this->product->paginateProduct(5);
        return view('product.index', compact('produtos'));
    }

    public function create(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $categorias = $categoryRepositoryInterface->listCategories();
        return view('product.create', compact('categorias'));
    }

    public function show($id)
    {
        $produto = $this->product->find($id);
        return view('product.show', compact('produto'));
    }

    public function store(Requests\ProductRequest $request)
    {
        $this->product->insertProduct($request->all());
        return redirect()->route('products');
    }

    public function destroy($id)
    {
        $this->product->deleteProduct($id);
        return redirect()->route('products');
    }

    public function edit($id, CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $produto = $this->product->findProduct($id);
        $categorias = $categoryRepositoryInterface->listCategories();
        $textareaTag = (count($produto->tags)) ? implode(', ', $produto->tags->lists('name')->toArray()) : '';

        return view('product.edit', compact('produto', 'categorias', 'textareaTag'));
    }

    public function update(Requests\ProductRequest $request, $id)
    {
        $this->product->updateProduct($id, $request->all());
        return redirect()->route('products');
    }
}
