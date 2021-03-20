<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "date", "status"
    ];

    protected $casts = [
        "date" => "datetime"
    ];

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function getStatusFormatedAttribute() {
        $data = [
            "opened" => "Em Aberto",
            "paid_out" => "Pago",
            "canceled" => "Cancelado"
        ];

        return $data[$this->attributes['status']];
    }
}
