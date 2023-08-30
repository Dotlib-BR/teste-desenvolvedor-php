<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
    ];

    public function inscricoes() // Corrigir para 'inscricoes' porque a pluralização do laravel criou a tabela inscricao como inscricaos e não inscricoes
    {
        return $this->hasMany(Inscricao::class);
    }
}
