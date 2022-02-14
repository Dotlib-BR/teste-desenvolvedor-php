<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id_product';
    protected $fillable = ['nameProduct', 'barCod', 'unitValue', 'amount'];

    public function clients()
    {
        return $this->belongsToMany('App\Client', 'orders', 'id_product', 'id_client');
    }
}
