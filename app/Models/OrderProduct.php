<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'user_id',
        'pedido_id',
        'produto_id',
    ];
    
    use HasFactory;
}
