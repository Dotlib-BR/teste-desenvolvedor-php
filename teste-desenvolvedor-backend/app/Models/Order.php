<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'product_id',
        'quantity',
        'total_price'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_has_products')->withPivot('quantity', 'price');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
