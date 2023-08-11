<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vaga;


class Candidato extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cpf', 'email', 'vaga_id', 'user_id'];

    // Relacionamento com a Vaga
    public function vaga()
    {
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }

     // Relacionamento com o Usuário
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
