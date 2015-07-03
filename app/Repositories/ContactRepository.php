<?php


namespace AGStore\Repositories;


use AGStore\Models\Contact;
use AGStore\Models\UserAddress;
use AGStore\Repositories\Contracts\ContactRepositoryInterface;

class ContactRepository extends AbstractRepository implements ContactRepositoryInterface
{

    /**
     * @param UserAddress $model
     */
    public function __construct(Contact $model)
    {
        /** @var UserAddress $model */
        $this->model = $model;
    }

    public function modelContact()
    {
        return $this->model();
    }

    public function findContact($id)
    {
        return $this->find($id);
    }

    public function allContact()
    {
        return $this->getAll();
    }

    public function listContact()
    {
        return $this->model()->lists('name', 'id');
    }

    public function paginateContact($number = 10)
    {
        return $this->model()->paginate($number);
    }

    public function insertContact(array $data)
    {
        return $this->create($data);
    }

    public function updateContact($id, array $data)
    {
        return $this->update($id, $data);
    }

    public function deleteContact($id)
    {
        return $this->delete($id);
    }
}