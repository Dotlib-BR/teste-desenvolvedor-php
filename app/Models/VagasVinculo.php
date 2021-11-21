<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VagasVinculo extends Model
{
    use HasFactory;

    protected $table = 'vagas_vinculos';

    protected $fillable = ['user_id', 'anuncio_id'];


}
