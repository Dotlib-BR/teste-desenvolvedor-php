<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Cliente extends Model
{


    use Sortable;

    protected $fillable = array('nome_cliente', 'cpf', 'email');

    public $sortable = ['id', 'nome_cliente', 'cpf','email'];


}
