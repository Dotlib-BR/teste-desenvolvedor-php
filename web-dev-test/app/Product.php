<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'bar_code', 'quantity'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }
}
