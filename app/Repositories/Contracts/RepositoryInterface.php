<?php


namespace AGStore\Repositories\Contracts;


interface RepositoryInterface {

    public function getAll();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);

}