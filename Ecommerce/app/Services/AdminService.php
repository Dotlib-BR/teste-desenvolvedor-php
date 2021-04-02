<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new AdminRepository();
    }

    /**
     * Update a user
     * @param int $id
     * @param array $data
     * @return array 
     */
    public function update(array $data)
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
                if (!$info) {
                    unset($data[$key]);
                }
            }
            $update = $this->repository->update($data);

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
            Log::error('ADMIN_SERVICE_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error updating.'
            ];
        }
    }
}
