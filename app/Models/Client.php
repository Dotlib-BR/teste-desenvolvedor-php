<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "cpf",
        "name",
        "email"
    ];

    public function Orders()    
    {
        return $this->hasMany(Order::class);
    }
}
