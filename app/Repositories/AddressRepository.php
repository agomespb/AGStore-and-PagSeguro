<?php


namespace AGStore\Repositories;


use AGStore\Models\UserAddress;
use AGStore\Repositories\Contracts\AddressRepositoryInterface;

class AddressRepository extends AbstractRepository implements AddressRepositoryInterface
{

    /**
     * @param UserAddress $model
     */
    public function __construct(UserAddress $model)
    {
        /** @var UserAddress $model */
        $this->model = $model;
    }

    public function modelAddress()
    {
        return $this->model();
    }

    public function findAddress($id)
    {
        return $this->find($id);
    }

    public function allAddress()
    {
        return $this->getAll();
    }

    public function listAddress()
    {
        // TODO: Implement listAddress() method.
    }

    public function paginateAddress($number)
    {
        // TODO: Implement paginateAddress() method.
    }

    public function insertAddress(array $data)
    {
        return $this->create($data);
    }

    public function updateAddress($id, array $data)
    {
        return $this->update($id, $data);
    }

    public function deleteAddress($id)
    {
        return $this->delete($id);

    }
}