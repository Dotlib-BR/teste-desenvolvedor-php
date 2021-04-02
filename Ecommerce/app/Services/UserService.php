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
     * List all users with per page or not
     * @param array $data 
     * @return array 
     */
    public function index(array $filter = [])
    {
        try {

            $data = $this->repository->index($filter ?? []);

            if ($data) {
                return [
                    'error' => 0,
                    'data' => $data['data']
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error bringing users.'
            ];

        } catch (\Exception $e) {

            Log::error('USER_SERVICE_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error bringing users.'
            ];
        }
    }

    /**
     * Create a new User
     * @param array $data 
     * @return array 
     */
    public function store(array $data)
    {
        try {

            if (!empty($data['image'])) {
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

            Log::error('CLIENTE_SERVICE_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error in validating the registration.'
            ];
        }
    }

    /**
     * Get a user
     * @param int $id 
     * @return array 
     */
    public function show(int $id)
    {

        try {

            $user = $this->repository->show($id);

            if ($user['error'] === 0) {
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
                'description' => 'Error bringing the user.'
            ];
        }
    }

    /**
     * Update a user
     * @param int $id
     * @param array $data
     * @return array 
     */
    public function update(int $id, array $data)
    {
        try {

            if (!empty($data['image'])) {
                $image = $data['image'];
                unset($data['image']);
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public/img/users', $imageName);
                $data['avatar'] = $imageName;
            }
            

            foreach ($data as $key => $info) {
                if (!$info || $key == '_method') {
                    unset($data[$key]);
                }

                if($key === 'document' && !empty($info)) {
                    $data[$key] = $this->clearDoc($info);
                }
            }

            $update = $this->repository->update($id, $data);

            if ($update) {
                return [
                    'error' => 0
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error updating.'
            ];
        } catch (\Exception $e) {
            Log::error('CLIENTE_SERVICE_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error updating.'
            ];
        }
    }

    /** 
     * Delete a user
     * @param mixed $id
     * @return array 
     */
    public function delete($id)
    {
        try{

            $data = [];
            if (is_integer($id) || is_string($id)) {
                $data[] = (int) $id;
            }

            if (is_array($id)) {
                foreach ($id['id'] as $item) {
                    $data[] = (int) $item;
                }
            }

            $delete = $this->repository->delete($data);

            if ($delete['error'] === 0) {
                return [
                    'error' => 0,
                ];
            }

            return [
                'error' => 1,
                'description' => $delete['description']
            ];

        } catch(\Exception $e) {
            
        }
    }

    /**
     * Removes punctuation from the document
     * @param string $doc
     * @return string The document string
     */
    private function clearDoc(string $doc)
    {
        $doc = str_replace(array(".", ',', "-", "/"), "", $doc);
        return $doc;
    }
}
