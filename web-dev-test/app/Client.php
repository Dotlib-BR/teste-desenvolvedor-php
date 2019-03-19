<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'cpf', 'email'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
