<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnologia extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'slug'];

    public $timestamps = false;

    public function vagas(){
        return $this->belongsToMany(Vaga::class, 'tecnologias', 'tecnologia_id', 'id', 'vaga_id', 'id');
    }
}
