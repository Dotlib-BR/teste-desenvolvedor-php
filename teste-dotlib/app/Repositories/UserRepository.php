<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    private $model;

    public function __construct(){}

    public function store(Request $request)
    {
        $request->merge(['cpf' => $this->formatCpf($request->get('cpf'))]);
        $request->merge(['password' => bcrypt($request->get('password'))]);

        try {
            $user = new User();
            $user->create($request->all());
        } catch (\Exception $err) {
            return $err;
        }

        return $user;
    }

    public function getUserByCpf($cpf) {
        $user = new User();
        $result = $user->where('cpf', $cpf)->get()->first();

        return $result;
    }

    public function formatCpf($cpf) {
        return str_replace('-', '', str_replace('.', '', $cpf));
    }
}
