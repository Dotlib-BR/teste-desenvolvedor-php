<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{

    /**
     * List all Users
     */
    public function index();

    /**
     * Get a single user
     * @param int $id User id
     */
    public function show(int $id);

    /**
     * Create a user
     * @param array $data User info
     */
    public function store(array $data);

    /**
     * Update a user
     * @param int $id User id
     * @param array $data User info
     */
    public function update(int $id, array $data);

    /**
     * Delete a user
     * @param int $id User id
     */
    public function delete(int $id);
}
