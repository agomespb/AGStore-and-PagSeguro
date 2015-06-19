<?php

namespace AGStore\Repositories\Contracts;


interface ProductRepositoryInterface {

    // aqui vão os métodos específicos Produtos.

    public function modelProduct();

    public function allProduct();

    public function findProduct($id);

    public function paginateProduct($number);

    public function insertProduct(array $data);

    public function updateProduct($id, array $data);

    public function deleteProduct($id);

    public function getFeatured($id);

    public function getRecommend($id);


}