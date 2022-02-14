<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Client extends Model
{
    protected $primaryKey = 'id_client';
    protected $fillable = ['name', 'cpf', 'email', 'password'];

    public function clients()
    {
        return $this->belongsToMany('App\Client', 'orders', 'id_product', 'id_client');
    }
}
