<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'price',
        'bar_code',
    ];

    /**
     * Get the formated client's cpf.
     *
     * @return string
     */
    public function getPriceFullAttribute()
    {
        return number_format($this->price, 2, ',' , '.');
    }
}
