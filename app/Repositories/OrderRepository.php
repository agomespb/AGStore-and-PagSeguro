<?php


namespace AGStore\Repositories;


use AGStore\Models\Order;
use AGStore\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository extends AbstractRepository implements OrderRepositoryInterface
{
    /**
     * @param Product $model
     */
    public function __construct(Order $model)
    {
        /** @var Product $model */
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function modelOrder()
    {
        return $this->model();
    }

    /**
     * @return mixed
     */
    public function allOrder()
    {
        return $this->getAll();
    }

    /**
     *
     */
    public function listOrder()
    {
        // TODO: Implement listOrder() method.
    }

    /**
     * @param $id
     * @return bool
     */
    public function findOrder($id)
    {
        return $this->find($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteOrder($id)
    {
        return $this->delete($id);
    }

    /**
     * @param $number
     */
    public function paginateOrder($number = 10)
    {
        return $this->model()->paginate($number);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertOrder(array $data)
    {
        return $this->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function updateOrder($id, array $data)
    {
        return $this->update($id, $data);
    }
}