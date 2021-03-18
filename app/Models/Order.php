<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'email',
        'CPF',
        'qty',
        'cost',
        'status',
        'product',
        'discount',
        'user_id',
    ];

    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product','order_products', 'pedido_id', 'produto_id');
    }
}
