<?php

namespace AGStore\Repositories\Contracts;


interface ContactRepositoryInterface {

    // aqui vão os métodos específicos desse repository.

    public function modelContact();

    public function findContact($id);

    public function allContact();

    public function listContact();

    public function paginateContact($number);

    public function insertContact(array $data);

    public function updateContact($id, array $data);

    public function deleteContact($id);
}