<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseInterface;

class BaseRepository implements BaseInterface
{

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return get_class($this->model);
    }

    public function get(?array $ids = null)
    {
        if ($ids !== null || is_array($ids)) {
            return $this->model->whereIn('id', $ids)->get();
        }
        return $this->model->get();
    }

    public function create(array $input)
    {
        return $this->model->create($input);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function updateOrCreate($where, $input)
    {
        return $this->model->updateOrCreate($where, $input);
    }

    public function where($where, $value)
    {
        return $this->model->where($where, $value);
    }


    public function update(int $id, array $input)
    {
        return $this->find($id)->update($input);
    }

    public function delete($id)
    {
        if (is_array($id)) {
            return $this->model->whereIn('id', $id)->delete();
        }

        return $this->find($id)->delete();
    }

}
