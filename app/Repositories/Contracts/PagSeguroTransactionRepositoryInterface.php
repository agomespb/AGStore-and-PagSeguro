<?php

namespace AGStore\Repositories\Contracts;


interface PagSeguroTransactionRepositoryInterface {

    // aqui vão os métodos específicos desse repository.

    public function modelTransaction();

    public function findByTransaction($code);

    public function findTransaction($id);

    public function saveTransaction($link);

    public function allTransaction();

    public function listTransaction();

    public function paginateTransaction($number);

    public function insertTransaction(array $data);

    public function updateTransaction($id, array $data);

    public function deleteTransaction($id);

    public function pagSeguroNotificationLink($notificationCode);

    public function updateOrderStatus($order_id, $status);

}