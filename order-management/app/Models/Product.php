<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['orders_id', 'name', 'barcode', 'amount', 'unit-price', 'created_at',
     'updated_at'];

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
