<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
    protected $table = 'produtos';
    public $timestamps = false;

    protected $fillable = [ 'CodBarras', 'Nome', 'ValorUnitario' ];
}
