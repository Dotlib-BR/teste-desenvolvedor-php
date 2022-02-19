<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'date_birth',
        'cpf',
        'phone',
        'stats',
        'cep',
        'address',
        'complement',
        'city',
        'sex',
    ];
}
