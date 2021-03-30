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

    public function index()
    {
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
                'description' => 'Usuario já cadastrado.'
            ];
        } catch (\Exception $e) {
            Log::error('USER_REPOSITORY_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao Cadastrar.'
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
                'description' => 'Erro ao atualizar.'
            ];
        } catch (\Exception $e) {
            Log::error('USER_REPOSITORY_Update', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao atualizar.'
            ];
        }
    }

    public function delete($id)
    {
    }

    /**
     * Get a user
     * @param int $id User id
     * @return array A array with error and data or error with description error
     */
    public function show(int $id)
    {
        try {
            $users = $this->model::find($id);

            if ($users) {
                return [
                    'error' => 0,
                    'data' => $users
                ];
            }

            return [
                'error' => 1,
                'description' => 'Erro ao trazer o usuario.'
            ];
        } catch (\Exception $e) {
            Log::error('USER_REPOSITORY_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao trazer o usuario.'
            ];
        }
    }
}
