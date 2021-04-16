<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Categoria extends Model
{
    use HasFactory;
    protected $table = "categorias";

    public function produtos(){
        return $this->hasMany(Produto::class);
    }
}
