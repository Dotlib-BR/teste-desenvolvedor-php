<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "quantity", "price", "bar_code"
    ];

    public function orders() {
        return $this->belongsToMany(Order::class)->withPivot("quantity");
    }

    public function delete() {
        $this->orders()->detach();
        parent::delete();
    }
}
