<?php


namespace AGStore\Repositories;

use AGStore\Models\Category;
use AGStore\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Session;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    /**
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        /** @var Category $model */
        $this->model = $model;
    }

    public function paginateCategory($number = 10)
    {
        return $this->model()->paginate($number);
    }

    public function modelCategory()
    {
        return $this->model();
    }

    public function findCategory($id)
    {
        return $this->find($id);
    }

    public function allCategories()
    {
        return $this->getAll();
    }

    public function listCategories()
    {
        return $this->model->lists('name', 'id');
    }

    public function insertCategory(array $data)
    {
        return $this->create($data);
    }

    public function updateCategory($id, array $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCategory($id)
    {
        $category = $this->find($id);

        if( count($category->products) ):
            Session::flash('flash_message', 'Não é possível excluir. Existem produtos relacionados a esta categoria.');
        else:
            $del = $this->delete($id);
            Session::flash('flash_message', 'Categoria excluída com sucesso!');
            return $del;
        endif;

        return false;
    }
}