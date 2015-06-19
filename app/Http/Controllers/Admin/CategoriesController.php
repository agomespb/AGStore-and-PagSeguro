<?php

namespace AGStore\Http\Controllers\Admin;

use AGStore\Http\Controllers\Controller;
use AGStore\Http\Requests;
use AGStore\Repositories\Contracts\CategoryRepositoryInterface;

class CategoriesController extends Controller
{

    protected $category;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->category = $categoryRepositoryInterface;
    }

    public function index()
    {
        $categories = $this->category->paginateCategory(3);
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function show($id)
    {
        $category = $this->category->findCategory($id);
        return view('category.show', compact('category'));
    }

    public function store(Requests\CategoryRequest $request)
    {
        $insert = $this->category->insertCategory($request->all());
        return redirect()->route('categories');
    }

    public function edit($id)
    {
        $category = $this->category->findCategory($id);
        return view('category.edit', compact('category'));
    }

    public function update(Requests\CategoryRequest $request, $id)
    {
        $this->category->updateCategory($id, $request->all());
        return redirect()->route('categories');
    }

    public function destroy($id)
    {
        $categoria = $this->category->deleteCategory($id);
        return redirect()->route('categories');
    }
}
