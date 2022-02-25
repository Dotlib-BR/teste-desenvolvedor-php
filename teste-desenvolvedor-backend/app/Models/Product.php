<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'bar_code',
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_has_products')->withPivot('quantity', 'price');
    }
}
