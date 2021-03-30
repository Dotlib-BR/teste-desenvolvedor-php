<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    /**
     * Create a new User
     * @param array $data User info
     * @return array A array with error and data or error with description error
     */
    public function store(array $data)
    {
        try {

            if(!empty($data['image'])){
                $image = $data['image'];
                unset($data['image']);
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public/img/users', $imageName);
                $data['avatar'] = $imageName;
            }

            $data['document'] = $this->clearDoc($data['document']);

            $store = $this->repository->store($data);

            if ($store['error'] === 0) {
                return [
                    'error' => 0,
                    'data' => $store
                ];
            }

            return [
                'error' => 1,
                'description' => $store['description']
            ];
        } catch (\Exception $e) {

            Log::error('CLIENTE_SERVICE_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro na validação do cadastro.'
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

            $user = $this->repository->show($id);
            if (!empty($user['error'])) {
                return $user;
            }

            return [
                'error' => 1,
                'description' => $user['description']
            ];
        } catch (\Exception $e) {

            Log::error('CLIENTE_SERVICE_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Erro ao trazer o usuario.'
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

            $update = $this->repository->update($id, $data);

            if($update) {
                return [
                    'error' => 0
                ];
            }

            return [
                'error' => 1,
                'description' => 'Erro ao atualizar.'
            ];

        } catch(\Exception $e) {
            Log::error('CLIENTE_SERVICE_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

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
     * Removes punctuation from the document
     * @param string $doc Document to be cleaned
     * @return string The document string
     */
    private function clearDoc(string $doc) {
        $doc = str_replace(array(".", ',', "-", "/"), "", $doc);
        return $doc;
    }

    /**
     * Add punctuation to the document 
     * @param
     */
    private function formatDocument(string $doc) {

    }
}
