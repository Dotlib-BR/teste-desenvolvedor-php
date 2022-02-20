<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date',
        'quantity',
        'amount'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class,'purchases_products', 'product_id', 'purache_id');
    }

}
