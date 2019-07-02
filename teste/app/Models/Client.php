<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'cpf', 'email'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
