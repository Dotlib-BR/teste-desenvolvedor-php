<?php

namespace App\Models;

use App\Contracts\AdvancedSearchable;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model implements AdvancedSearchable
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class, 'id', 'discount_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function getTotalValueAttribute()
    {
        $orderProducts = $this->orderProducts()->get(['quantity', 'unit_price']);
        
        $total = 0;
        foreach($orderProducts as $product)
        {
            $total = $product->unit_price * $product->quantity;
        }
        return $total;
    }

    public function getTotalDiscountedAttribute()
    {
        return $this->applyDiscount($this->getTotalValueAttribute());
    }

    private function applyDiscount($total)
    {      
        if (! $this->discount()->count())
        {
            return $total;
        }

        $discount = $this->discount()->first();
        if ($discount->percent_off && ! $discount->value_off)
        {
            return $total - ($total * ($discount->percent_off/100));
        }

        if ($discount->value_off && ! $discount->percent_off) {
            if ($total < $discount->value_off) {
                return $total;
            }
            return $total - $discount->value_off;
        }

        return ($total - ($total * ($discount->percent_off/100))) - $discount->value_off;
    }

    public static function scopeAdvancedSearch($query, $param)
    {
        $query->join('clients', 'clients.id', 'orders.client_id')
            ->select('clients.name', 'orders.*')
            ->where('clients.name', 'like', "%$param%");
    }

    public function listedFormat() 
    {
        return "$this->id - ".$this->client->name;
    }

    public function displayResultFormat()
    {
        return "$this->id - ".$this->client->name;
    }
     
    public function resultFormat()
    {
        return $this->id;
    }
}
