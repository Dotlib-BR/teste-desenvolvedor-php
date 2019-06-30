<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'code'
    ];

    /**
     * Get the orders.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }
}
