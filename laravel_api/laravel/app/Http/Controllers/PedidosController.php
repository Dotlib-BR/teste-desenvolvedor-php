<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoAddRequest;
use App\Http\Requests\PedidoUpdateRequest;
use App\Models\Clients;
use App\Models\Pedidos;
use App\Models\Products;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function all()
    {
        $pedidos = Pedidos::all();

        return response()->json($pedidos);
    }

    public function create()
    {
        $clients = Clients::all()->where('stats', 1);
        $products = Products::all()->where('stats', 1);

        return response(['clients' => $clients, 'products' => $products]);
    }

    public function add(PedidoAddRequest $request)
    {
        if ($request->validated()) {
            $client = Clients::where('id', $request->client)->first();
            $product = Products::where('id', $request->product)->first();

            if (intval($product->amount) >= intval($request->amount)) {
                $value_total = $request->amount * $product->value;
                $newPedido = new Pedidos();
                $newPedido->client_id = $client->id;
                $newPedido->product_id = $product->id;
                $newPedido->name_client = $client->name;
                $newPedido->email_client = $client->email;
                $newPedido->cpf_client = $client->cpf;
                $newPedido->cod_bars_product = $product->cod_bars;
                $newPedido->name_product = $product->name;
                $newPedido->value_un_product = $product->value;
                $newPedido->amount = $request->amount;
                $newPedido->value_total = $value_total;
                $newPedido->date_pedido = $request->date_pedido;
                $newPedido->stats = 1;

                if ($newPedido->save()) {
                    $new_amount = intval($product->amount) - intval($request->amount);
                    Products::where('id', $product->id)->update(['amount' => $new_amount]);

                    if ($new_amount == 0) {
                        Products::where('id', $product->id)->update(['stats' => 0]);
                    }
                }

                return response()->json('success');
            }

            return response()->json('amount');
        }
    }

    public function show(Pedidos $pedido, Request $request)
    {
        return response()->json($pedido);
    }

    public function serchID(Pedidos $pedido, Request $request)
    {
        return response()->json($pedido);
    }

    public function update(Pedidos $pedido, PedidoUpdateRequest $request)
    {
        if ($request->validated()) {
            $pedido_atual = Pedidos::where('id', $request->id)->first();

            if ($request->stats == 0) {
                $product_pedido = Products::where('id', $pedido_atual->product_id)->first();
                $new_amount_product = $product_pedido->amount + $pedido->amount;
                Products::where('id', $pedido->product_id)->update(['amount' => $new_amount_product]);
            }
            
            $format_date = date('Y-m-d h:m',  strtotime($request->date_pedido));
            $pedido->date_pedido = $format_date;
            $pedido->stats = $request->stats;
            $pedido->save();

            return response()->json('success');
        }
    }

    public function delete(Pedidos $pedido, Request $request)
    {
        if ($pedido->delete()) {
            return response()->json('success');
        }
    }
}
