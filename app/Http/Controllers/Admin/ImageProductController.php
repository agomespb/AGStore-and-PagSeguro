<?php

namespace AGStore\Http\Controllers\Admin;

use AGStore\Http\Controllers\Controller;
use AGStore\Http\Requests;
use AGStore\Http\Requests\ProductImageRequest;
use AGStore\Repositories\Contracts\ImageProductRepositoryInterface;
use AGStore\Repositories\Contracts\ProductRepositoryInterface;

class ImageProductController extends Controller
{
    protected $product;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->product = $productRepositoryInterface;
    }

    public function index($id)
    {
        $produto = $this->product->findProduct($id);
        return view('product.images', compact('produto'));
    }

    public function create($id)
    {
        $produto = $this->product->find($id);
        return view('product.create_image', compact('produto'));
    }

    public function store($id, ProductImageRequest $request, ImageProductRepositoryInterface $imageProductRepositoryInterface)
    {
        $imageProductRepositoryInterface->insertImage($id, $request->all());
        return redirect()->route('products_images', $id);
    }

    public function destroy($id, ImageProductRepositoryInterface $imageProductRepositoryInterface)
    {
        $produto_id = $imageProductRepositoryInterface->deleteImage($id);
        return redirect()->route('products_images', ['id' => $produto_id]);
    }

}
