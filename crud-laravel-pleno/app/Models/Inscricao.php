<?php

namespace App\Models;

use App\Models\Inscricao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaga_id',
        'candidato_id',
        'data_inscricao',
    ];

    public function vaga()
    {
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'candidato_id');
    }
}
