<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code', 'percentage'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
