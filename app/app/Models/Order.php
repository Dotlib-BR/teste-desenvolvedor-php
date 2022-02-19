<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'bought_at',
        'costumer_id',
        'status'
    ];

    protected $appends = [
        'total_price',
        'readable_status'
    ];

    public function costumer()
    {
        return $this->belongsTo(Costumer::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
            ->withPivot('quantity');
    }

    public function getTotalPriceAttribute()
    {
        return $this->products->sum('price');
    }

    public function getReadableStatusAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'Em aberto';
            case 1:
                return 'Pago';
            case 2:
                return 'Cancelado';
            default:
                return 'Não definido';
        }
    }
}
