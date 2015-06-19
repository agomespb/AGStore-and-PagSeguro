<?php

namespace AGStore\Repositories\Contracts;


interface CategoryRepositoryInterface {

    // aqui vão os métodos específicos desse repository.

    public function modelCategory();

    public function findCategory($id);

    public function allCategories();

    public function listCategories();

    public function paginateCategory($number);

    public function insertCategory(array $data);

    public function updateCategory($id, array $data);

    public function deleteCategory($id);


}