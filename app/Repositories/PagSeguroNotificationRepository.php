<?php


namespace AGStore\Repositories;


use AGStore\Models\PagSeguroNotification;
use AGStore\Repositories\Contracts\PagSeguroNotificationRepositoryInterface;

class PagSeguroNotificationRepository extends AbstractRepository implements PagSeguroNotificationRepositoryInterface
{

    /**
     * @param PagSeguro $model
     */
    public function __construct(PagSeguroNotification $model)
    {
        /** @var PagSeguro $model */
        $this->model = $model;
    }

    public function modelNotification()
    {
        return $this->model();
    }

    public function findNotification($id)
    {
        return $this->find($id);
    }

    public function allNotification()
    {
        return $this->getAll();
    }

    public function listNotification()
    {
        return $this->model()->lists('notificationCode', 'id');
    }

    public function paginateNotification($number = 10)
    {
        return $this->model()->paginate($number);
    }

    public function insertNotification(array $data)
    {
        return $this->create($data);
    }

    public function updateNotification($id, array $data)
    {
        return $this->update($id, $data);
    }

    public function deleteNotification($id)
    {
        return $this->delete($id);
    }
}