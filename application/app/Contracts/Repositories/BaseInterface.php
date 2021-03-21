<?php

namespace App\Contracts\Repositories;

interface BaseInterface
{

    public function getModel();

    public function create(array $input);

    public function find($id);

    public function updateOrCreate($where, $input);

    public function where($where, $value);

}
