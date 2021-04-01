<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{

    /**
     * List all products
     * @filter info
     */
    public function index(array $data);

    /**
     * Get a single product
     * @param int $id Product id
     */
    public function show(int $id);

    /**
     * Create a product
     * @param array $data Product info
     */
    public function store(array $data);

    /**
     * Update a product
     * @param int $id Product id
     * @param array $data Product info
     */
    public function update(int $id, array $data);

    /**
     * Delete a product
     * @param array $id Many products id
     */
    public function delete(array $id);
}
