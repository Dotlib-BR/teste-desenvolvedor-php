<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'sobrenome', 'data_nascimento', 'genero', 'cpf', 'endereco', 'telefone', 'celular', 'email'
    ];

    protected $dates = [
        'data_nascimento',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inscricoes(){
        return $this->hasManyThrough(
            Vaga::class,
            CandidatoVaga::class,
            'candidato_id',
            'id',
            'id',
            'vaga_id',
        );
    }

    public function vagasinscritas(){

        return $this->belongsToMany(Vaga::class, 'candidato_vaga')->withPivot(['aplicado_em', 'path_curriculo', 'status'])->withTimestamps();
    }
}
