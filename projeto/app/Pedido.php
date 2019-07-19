<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id', 'data', 'status', 'valor', 'desconto_id'];

    public function clientes()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }

    public function itensPedidos()
    {
        return $this->hasMany('App\ItensPedido');
    }

    public function descontos()
    {
        return $this->belongsTo('App\Desconto', 'desconto_id');
    }
    
    public function getStatus($st = '')
    {        
        $status = [
            1 => "Nao Finalizado", //Pedido não encerrado
            2 => "Em Aberto - Aguardando Pagamento", //Pedido encerrado aguardando pagamento
            3 => "Pago", //Pedido encerrado e pago
            4 => "Cancelado" //Pedido cancelado
        ];

        if(!empty($st)){
            return ($status[$st]);
        }

        return $status;
    }
}
