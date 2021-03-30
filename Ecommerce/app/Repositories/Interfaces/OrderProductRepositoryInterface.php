<?php

namespace App\Repositories\Interfaces;

interface OrderProductRepositoryInterface
{

    /**
     * List all orders
     */
    public function index();

    /**
     * Get a single order product
     * @param int $id Order Product id
     */
    public function show(int $id);

    /**
     * Create a order products
     * @param array $data Order Product info
     */
    public function store(array $data);

    /**
     * Update a order product
     * @param int $id Order Product id
     * @param array $data Order Product info
     */
    public function update(int $id, array $data);

    /**
     * Delete a order product
     * @param int $id Order Product id
     */
    public function delete(int $id);
}
