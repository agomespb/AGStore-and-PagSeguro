<?php
/**
 * Created by PhpStorm.
 * User: agomes
 * Date: 13/06/15
 * Time: 23:07
 */

namespace AGStore\Repositories\Contracts;


interface UserRepositoryInterface {
    // aqui vão os métodos específicos Produtos.

    public function modelUser();

    public function allUser();

    public function findUser($id);

    public function paginateUser($number);

    public function insertUser(array $data);

    public function updateUser($id, array $data);

    public function deleteUser($id);
}