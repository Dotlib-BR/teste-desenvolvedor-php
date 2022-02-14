<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $primaryKey = 'id_order';
    protected $fillable = ['id_client', 'id_product', 'status', 'dtPedido'];

    public static function getAllOrders()
    {
        $order = DB::table('orders')
            ->join('products', 'products.id_product', '=', 'orders.id_product')
            ->join('clients', 'clients.id_client', '=', 'orders.id_client')
            ->select(
                /*orders*/
                'orders.id_product',
                'orders.id_client',
                'orders.status',
                'orders.dtPedido',
                /*products*/
                'products.nameProduct as produto',
                'products.barCod as barCod',
                'products.unitValue as unitValue',
                /*clients*/
                'clients.name as nome',
                'clients.cpf as cpf',
                'clients.email as email'
            )
            ->get();
        return $order;
    }

    public static function getOrder($id)
    {
        $order = DB::table('orders')
            ->join('products', 'products.id_product', '=', 'orders.id_product')
            ->join('clients', 'clients.id_client', '=', 'orders.id_client')
            ->select(
                /*orders*/
                'orders.id_product',
                'orders.id_client',
                'orders.status',
                'orders.dtPedido',
                /*products*/
                'products.nameProduct as produto',
                'products.barCod as barCod',
                'products.unitValue as unitValue',
                /*clients*/
                'clients.name as nome',
                'clients.cpf as cpf',
                'clients.email as email'
            )
            ->where('clients.id_client', '=', $id)
            ->get();
        return $order;
    }
}
