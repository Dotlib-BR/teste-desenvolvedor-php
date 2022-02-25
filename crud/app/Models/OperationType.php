<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationType extends Model
{
    protected $guarded = [];

    protected $table  = 'operation_type';
    
    use HasFactory;
}
