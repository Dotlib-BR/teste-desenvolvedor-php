<?php

namespace App\Services;

use App\Contracts\Repositories\ClienteInterface;
use Illuminate\Support\Facades\Validator;

class ClienteService extends BaseService
{
    public function __construct(ClienteInterface $clienteInterface)
    {
        parent::__construct($clienteInterface);
    }

    public function create(string $nome, string $email, $cpf, string $password = null)
    {
        $password = (!empty($password)) ? bcrypt($password) : null;

        if ($this->findColumn('email', $email)) {
            throw new \Exception("E-mail já está cadastrado", 1);
        }

        return $this->repository->create([
            'nome'  => $nome,
            'email' => $email,
            'cpf'   => preg_replace('/[^0-9]/', '', $cpf),
            'password' => $password,
        ]);
    }
}
