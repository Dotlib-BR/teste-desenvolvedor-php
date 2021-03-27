<?php

namespace App\Models;

use App\Traits\FilterModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use FilterModel, SoftDeletes;

    protected $fillable = [
        'cliente_id',
        'status_pedido_id',
        'cupom_desconto_id',
        'numero_pedido',
        'valor_pedido',
        'valor_desconto',
        'valor_total',
    ];

    /**
     * Get all of the produtos for the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produtos()
    {
        return $this->hasMany(PedidoProduto::class);
    }

    /**
     * Get the cliente associated with the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Get the statusPedido associated with the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function statusPedido()
    {
        return $this->belongsTo(StatusPedido::class);
    }

    /**
     * Get the cupomDesconto associated with the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cupomDesconto()
    {
        return $this->belongsTo(CupomDesconto::class);
    }

    /**
     * Get all of the pedidoProdutos for the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidoProdutos()
    {
        return $this->hasMany(PedidoProduto::class);
    }

    public function scopeFilter($query)
    {
        $input = array_filter(request()->all());

        if (isset($input['q'])) {
            $query->whereHas('cliente', function (Builder $query) use ($input) {
                $query->where('nome', 'like', '%' . $input['q'] . '%')->orWhere('email', $input['q'])->orWhere('cpf', $input['q']);
            });
        }

        if (isset($input['status_pedido_id'])) {
            $query->where('status_pedido_id', $input['status_pedido_id']);
        }

        return $query;
    }
}
