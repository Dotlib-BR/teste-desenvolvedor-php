<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
