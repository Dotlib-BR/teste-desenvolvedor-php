<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientsController extends Controller
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index($filter) {
        $clients = User::
                    where('admin', 0)
                    ->orderBy($filter, 'desc')
                    ->simplePaginate(20);
        return view('clients', [
            'clients' => $clients
        ]);
    }

    public function showAjax($id) {
        return $this->userRepository->getUserByIdAjax($id);
    }

    public function destroyAjax($id) {
        return $this->userRepository->destroyUserByIdAjax($id);
    }
}
