<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->Pedido = new Pedido();
    }

    public function showAllPedido(Request $request){
        return $this->Pedido->showAll($request);
    }

    public function showOnePedido($id){
        return $this->Pedido->showOne($id);
    }

    public function createPedido(Request $request)
    {
        return $this->Pedido->cadastro($request);
    }

    public function updatePedido(Request $request, $id){
        return $this->Pedido->atualizar($request, $id);
    }

    public function payPedido($id)
    {
        return $this->Pedido->pagar($id);
    }

    public function cancelPedido($id)
    {
        return $this->Pedido->cancelar($id);
    }

    public function deletePedido($id)
    {
        return $this->Pedido->deletar($id);
    }
}
