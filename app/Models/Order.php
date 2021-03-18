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
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class,'order_products', 'pedido_id', 'produto_id');
    }
}
