<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuxVagasUsers extends Model
{
    use HasFactory;

    protected $table = 'aux_vagas_users';

    protected $fillable = [
        'id',
        'user_id',
        'vaga_id'
    ];
}
