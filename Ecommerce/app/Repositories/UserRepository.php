<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{

    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * List all users
     * @param array $data Filter info
     * @return array A array with error and data or error with description error
     */
    public function index(array $data = [])
    {
        try {
            $perPage = (int) (!empty($data['perPage'])) ? $data['perPage'] : 10;
            $list = [];

            if (!empty($data['all'])) {
                $list = $this->model->get();
            }

            if(!empty($data['ids'])) {
                $list = $this->model->whereIn('id', $data['ids'])->get();
            }

            if (!count($list)) {

                $list = $this->model;
                if (!empty($data['filter'])) {
                    $list = $list->orderBy('name', $data['filter']);
                }

                $list = $list->paginate($perPage, ['*'], 'page', $data['page'] ?? null);
            }

            if ($list) {
                return [
                    'error' => 0,
                    'data' => $list
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error bringing all users.'
            ];
        } catch (\Exception $e) {

            Log::error('USER_REPOSITORY_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing all users.'
            ];
        }
    }

    /**
     * Create a new User
     * @param array $data User info
     * @return array A array with error and data or error with description error
     */
    public function store(array $data)
    {
        try {
            $info = [
                'name' => $data['name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'document' => $data['document'],
                'password' => Hash::make($data['password']),
            ];

            if(!empty($data['avatar'])){
                $info['avatar'] = $data['avatar'];
            }
            $store = $this->model->create($info);
            if ($store) {
                return [
                    'error' => 0,
                    'data' => $store
                ];
            }

            return [
                'error' => 1,
                'description' => 'User already registered.'
            ];
        } catch (\Exception $e) {
            Log::error('USER_REPOSITORY_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error when registering.'
            ];
        }
    }

    /**
     * Update a user
     * @param int $id User id
     * @param array $data User info
     * @return array A array with error and data or error with description error
     */
    public function update(int $id, array $data)
    {
        try {

            $update = $this->model::where('id', $id)->update($data);

            if ($update) {
                return [
                    'error' => 0,
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error updating.'
            ];
        } catch (\Exception $e) {
            Log::error('USER_REPOSITORY_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error updating.'
            ];
        }
    }

    /**
     * Delete a Product
     * @param array $ids Product id
     * @return array A array with error and data or error with description error
     */
    public function delete(array $ids)
    {
        try {

            $delete = $this->model->whereIn('id', $ids)->delete();

            if ($delete) {
                return [
                    'error' => 0,
                    'data' => $delete
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error deleting the user.'
            ];
        } catch (\Exception $e) {
            Log::error('USER_REPOSITORY_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error deleting the user.'
            ];
        }
    }

    /**
     * Get a user
     * @param int $id User id
     * @return array A array with error and data or error with description error
     */
    public function show(int $id)
    {
        try {
            $user = $this->model::find($id);

            if ($user) {
                return [
                    'error' => 0,
                    'data' => $user
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error bringing the user.'
            ];
        } catch (\Exception $e) {
            Log::error('USER_REPOSITORY_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing the user.'
            ];
        }
    }
}
