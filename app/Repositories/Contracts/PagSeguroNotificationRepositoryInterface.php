<?php

namespace AGStore\Repositories\Contracts;


interface PagSeguroNotificationRepositoryInterface {

    // aqui vão os métodos específicos desse repository.

    public function modelNotification();

    public function findNotification($id);

    public function allNotification();

    public function listNotification();

    public function paginateNotification($number);

    public function insertNotification(array $data);

    public function updateNotification($id, array $data);

    public function deleteNotification($id);
}