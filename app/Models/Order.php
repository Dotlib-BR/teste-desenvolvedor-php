<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{ Product, Customer };

class Order extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
