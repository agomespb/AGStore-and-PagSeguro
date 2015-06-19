<?php

namespace AGStore\Repositories;


use AGStore\Repositories\Contracts\UserRepositoryInterface;
use AGStore\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        /** @var User $model */
        $this->model = $model;
    }

    public function modelUser()
    {
        return $this->model();
    }

    public function allUser()
    {
        return $this->getAll();
    }

    public function findUser($id)
    {
        return $this->find($id);
    }

    public function paginateUser($number = 10)
    {
        return $this->model()->paginate($number);
    }

    public function insertUser(array $data)
    {
        return $this->create($data);
    }

    public function updateUser($id, array $data)
    {
        return $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }
}