<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product',
        'bar_code',
        'price',
    ];
    
    use HasFactory;

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products', 'produto_id', 'pedido_id');
    }
}
