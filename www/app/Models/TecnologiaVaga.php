<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TecnologiaVaga extends Model
{
    use HasFactory;

    protected $table = 'tecnologia_vaga';
    public $timestamps = false;
    public $incrementing = false;
}
