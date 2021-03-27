<?php

namespace App\Contracts\Repositories;

interface BaseInterface
{

    public function getModel();

    public function get(array $ids = null);

    public function paginate($pag = 20);

    public function create(array $input);

    public function find($id);

    public function updateOrCreate($where, $input);

    public function where($where, $value);

    public function update(int $id, array $input);

    public function delete($id);

    public function newQuery();

}
