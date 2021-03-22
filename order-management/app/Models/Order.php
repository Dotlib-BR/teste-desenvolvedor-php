<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function clients(){
        return $this->belongTo(Client::class);
    }

    public function productss(){
        return $this->belongToMany(Product::class);
    }
}