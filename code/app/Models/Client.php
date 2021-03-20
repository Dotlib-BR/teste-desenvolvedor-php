<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "email", "cpf"
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function delete() {
        foreach($this->orders()->get() as $order) {
            $order->client()->dissociate();
            $order->save();
        }
        parent::delete();
    }
}
