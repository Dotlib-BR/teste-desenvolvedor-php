<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterModel;

class Cliente extends Model
{
    use SoftDeletes, FilterModel;

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'password',
        'api_token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


}
