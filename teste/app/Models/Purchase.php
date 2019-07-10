<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id', 'discount_id', 'status_id',
        'invoice_number', 'total'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        //Poderia renomear a tabela de orders para uma tabela pivot chamada de 'product_purchase'
        //para utilizar o sync ou attach para relacionar mas por questões de nomenclatura
        //vou trablhar dessa forma utilizando a tabela orders.
        return $this->belongsToMany(
            Product::class, 'orders',
            'purchase_id', 'product_id'
        );
    }
}
