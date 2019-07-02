<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'barcode', 'price'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function purchases()
    {
        //Poderia renomear a tabela de orders para uma tabela pivot chamada de 'product_purchase'
        //para utilizar o sync ou attach para relacionar mas por questões de nomenclatura
        //vou trablhar dessa forma utilizando a tabela orders.
        return $this->belongsToMany(
            Purchase::class, 'orders',
            'product_id', 'purchase_id'
        );
    }
}
