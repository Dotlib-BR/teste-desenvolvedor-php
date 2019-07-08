<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id', 'purchase_id', 'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
