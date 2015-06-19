<?php

namespace AGStore\Repositories\Contracts;


interface ImageProductRepositoryInterface {

    // aqui vão os métodos específicos Produtos.

    public function modelImage();

    public function allImage();

    public function findImage($id);

    public function insertImage($id, array $data);

    public function deleteImage($id);
}