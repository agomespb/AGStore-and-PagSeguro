<?php

namespace AGStore\Repositories;


use AGStore\Models\Tag;
use AGStore\Repositories\Contracts\TagRepositoryInterface;

class TagRepository extends AbstractRepository implements TagRepositoryInterface
{

    /**
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        /** @var Tag $model */
        $this->model = $model;
    }


    public function modelTag()
    {
        return $this->model;
    }

    public function findTag($id)
    {
        return $this->find($id);
    }

    public function allTag()
    {
        return $this->getAll();
    }

    public function listTag()
    {
        return $this->model->lists('name', 'id');
    }

    public function paginateTag($number)
    {
        return $this->model()->paginate($number);
    }

    public function insertTag(array $data)
    {
        return $this->create($data);
    }

    public function updateTag($id, array $data)
    {
        return $this->update($id, $data);
    }

    public function deleteTag($id)
    {
        return $this->delete($id);
    }
}