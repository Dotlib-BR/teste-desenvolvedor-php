<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['orders_id', 'name', 'cpf', 'email'];

    public function orders(){
        return $this->hasMany(Order::class);
    }
    
}