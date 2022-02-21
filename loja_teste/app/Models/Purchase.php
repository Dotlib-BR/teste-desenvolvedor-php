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
        'amount',
        'status'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'purchases_products', 
        'purchase_id', 'product_id')->withPivot('quantity', 'product_price');;
    }

}
