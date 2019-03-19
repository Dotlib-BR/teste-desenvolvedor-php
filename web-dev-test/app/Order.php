<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'number', 'order_date'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
