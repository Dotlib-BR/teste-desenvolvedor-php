<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    use HasFactory;

    protected $table = 'product_request';

    protected $fillable = [
        'request_id',
        'product_id',
        'qtd'
    ];
}
