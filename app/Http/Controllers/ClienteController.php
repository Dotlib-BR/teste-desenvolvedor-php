<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->Cliente = new Cliente();
    }

    public function showAllCliente(Request $request){
        return $this->Cliente->showAll($request);
    }

    public function showOneCliente($id){
        return $this->Cliente->showOne($id);
    }

    public function createCliente(Request $request)
    {
        return $this->Cliente->cadastro($request);
    }

    public function updateCliente(Request $request, $id){
        return $this->Cliente->atualizar($request, $id);
    }

    public function deleteCliente($id)
    {
        return $this->Cliente->deletar($id);
    }
}
