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
        'name', 
        'price',
        'bar_code',
    ];

    /**
     * Get the formated client's cpf.
     *
     * @return string
     */
    public function getPriceFullAttribute()
    {
        return number_format($this->price, 2, ',' , '.');
    }

    /**
     * Get the orders record's associated with the product.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }
}
