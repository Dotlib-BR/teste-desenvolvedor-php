<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id', 'slug', 'titulo', 'nivel', 'categoria', 'regime', 'salario', 'descricao', 'is_paused'];

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    public function tags(){
        return $this->hasManyThrough(
            Tecnologia::class,
            TecnologiaVaga::class,
            'vaga_id',
            'id',
            'id',
            'tecnologia_id',
        );
    }

    public function inscritos(){
        return $this->hasManyThrough(
            Candidato::class,
            CandidatoVaga::class,
            'vaga_id',
            'id',
            'id',
            'candidato_id',
        );
    }

    public function candidatos(){
        return $this->belongsToMany(Candidato::class, 'candidato_vaga')->withPivot(['aplicado_em', 'path_curriculo', 'status'])->withTimestamps();
    }

    public function tecnologias(){
        return $this->belongsToMany(Tecnologia::class, 'tecnologia_vaga');
    }

    public function scopePaused($query, $valor = false)
    {
        return $query->where('is_paused', $valor);
    }
}
