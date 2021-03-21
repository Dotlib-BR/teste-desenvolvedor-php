<?php

namespace App\Repositories;

class BaseRepository
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
}
