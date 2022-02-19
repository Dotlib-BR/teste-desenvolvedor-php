<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Produto extends Model
{
    use HasFactory;
    use Sortable;

    protected $primaryKey = 'Id_produto';
    public $timestamps = false;


    protected $fillable = [
        'Nome_produto',
        'Id_produto',
        'CodBarras',
        'ValorUnitario',
    ];

    public $sortable = [
      'Nome_produto',
      'Id_produto',
      'CodBarras',
      'ValorUnitario',
  ];

}
