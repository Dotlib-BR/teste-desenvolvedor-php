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

}
