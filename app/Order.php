<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['customer_id', 'product_id', 'status_id', 'order_date', 'quantity'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    /*public function products()
    {
        return $this->belongsToMany('App\Product');
    }*/
}
