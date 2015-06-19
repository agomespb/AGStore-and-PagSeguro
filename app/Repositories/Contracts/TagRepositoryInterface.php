<?php

namespace AGStore\Repositories\Contracts;


interface TagRepositoryInterface {

    // aqui vão os métodos específicos desse repository.

    public function modelTag();

    public function findTag($id);

    public function allTag();

    public function listTag();

    public function paginateTag($number);

    public function insertTag(array $data);

    public function updateTag($id, array $data);

    public function deleteTag($id);


}