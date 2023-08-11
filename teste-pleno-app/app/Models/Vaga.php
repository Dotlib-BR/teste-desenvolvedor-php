<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Candidato;

class Vaga extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'tipo', 'status', 'email'];

    // Relacionamento com os Candidatos
    public function candidatos()
    {
        return $this->hasMany(Candidato::class, 'vaga_id');
    }
}
