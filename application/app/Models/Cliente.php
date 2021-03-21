<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
