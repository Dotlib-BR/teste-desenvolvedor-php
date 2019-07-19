<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'codbarras', 'valorUnt'];

    public function itensPedidos()
    {
        return $this->hasMany('App\ItensProduto', 'produto_id');
    }
}
