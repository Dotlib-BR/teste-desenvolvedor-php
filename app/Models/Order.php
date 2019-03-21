<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'client_id',
        'number',
        'date_order',
        'discount',
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date_order',
    ];

    /**
     * Get the status record associated with the order.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the client record associated with the order.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the products record's associated with the order.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot(['price', 'quantity'])
            ->withTimestamps();
    }

    /**
     * Get the order's discount.
     *
     * @return string
     */
    public function getDiscountFullAttribute()
    {
        return number_format($this->discount, 2, ',', '.');
    }

    /**
     * Set the order's discount.
     *
     * @return string
     */
    public function setDiscountAttribute($value)
    {
        $this->attributes['discount'] = $value ? $value : 0.00;
    }

    /**
     * Get the order's total.
     *
     * @return string
     */
    public function getTotalAttribute()
    {
        $total = 0;
        $products = $this->products;
        
        foreach ($products as $product) {
            $total += $product->pivot->price * $product->pivot->quantity;
        }
        
        if ($this->discount < $total) {
            $total -= $this->discount;
        } else {
            $total = 0.00;
        }

        return number_format($total, 2, ',', '.');
    }

    /**
     * Get the oerder's user.
     * 
     * @param int $userId
     * 
     * @return int
     */
    public function getOrdersFromUser(int $userId)
    {
        return $this->wherehas('client', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->count();
    }
}
