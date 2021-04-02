<?php

namespace App\Repositories\Interfaces;

interface AdminRepositoryInterface
{
    /**
     * Update admin info
     * @param array $data
     */
    public function update(array $data);
}
