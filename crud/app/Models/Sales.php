<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    protected $guarded = [];

    protected $table  = 'sales';
    
    use HasFactory;
}
