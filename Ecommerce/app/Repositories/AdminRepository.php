<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminRepository implements AdminRepositoryInterface
{

    private $model;

    public function __construct()
    {
        $this->model = new Admin();
    }


    public function update(array $data)
    {
        try {

            $id = Auth::guard('admin')->user()->id;
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
            Log::error('ADMIN_REPOSITORY_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error updating.'
            ];
        }
    }
}
