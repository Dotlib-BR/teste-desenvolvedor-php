<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        "bar_code",
        "name",
        "price"
    ];

    public function Orders()
    {
        return $this->belongsTo(Order::class);
    }
}
