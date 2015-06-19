<?php

namespace AGStore\Repositories\Contracts;


interface AddressRepositoryInterface {

    // aqui vão os métodos específicos desse repository.

    public function modelAddress();

    public function findAddress($id);

    public function allAddress();

    public function listAddress();

    public function paginateAddress($number);

    public function insertAddress(array $data);

    public function updateAddress($id, array $data);

    public function deleteAddress($id);
}