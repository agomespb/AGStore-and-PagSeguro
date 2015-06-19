<?php

namespace AGStore\Repositories;


abstract class AbstractRepository implements Contracts\RepositoryInterface
{
    protected $model;

    /**
     * @return mixed
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return bool if false and mixed to true
     */
    public function find($id)
    {
        $search = $this->model->find($id);

        if( count($search) ) {
            return $search;
        }

        return false;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $insert = $this->model->fill($data);
        $insert->save();

        return $insert;
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $search = $this->model->find($id);

        if( count($search) ) {
            $search->update($data);
        }

        return $search;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $search = $this->model->find($id);

        if( count($search) ) {
            return $search->delete();
        }

        return false;
    }

}
