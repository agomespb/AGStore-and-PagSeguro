<?php


namespace AGStore\Repositories\Contracts;


interface OrderRepositoryInterface {

    // aqui vão os métodos específicos desse repository.

    public function modelOrder();

    public function allOrder();

    public function listOrder();

    public function findOrder($id);

    public function deleteOrder($id);

    public function paginateOrder($number);

    public function insertOrder(array $data);

    public function updateOrder($id, array $data);

}