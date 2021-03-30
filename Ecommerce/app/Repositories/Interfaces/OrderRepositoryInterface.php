<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{

    /**
     * List all order
     */
    public function index();

    /**
     * Get a single order
     * @param int $id Order id
     */
    public function show(int $id);

    /**
     * Create a order
     * @param array $data Order info
     */
    public function store(array $data);

    /**
     * Update a order
     * @param int $id Order id
     * @param array $data Order info
     */
    public function update(int $id, array $data);

    /**
     * Delete a order
     * @param array $id Many Order id
     */
    public function delete(array $id);
}
