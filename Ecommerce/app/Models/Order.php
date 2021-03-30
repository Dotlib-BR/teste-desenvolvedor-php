<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * Disable auto timestamp
     *
     */
    public $timestamps = false;

    /**
     * Atributtes
     *
     * @var array
     */
    protected $fillable = [
        'n_order',
        'id_user',
        'total_price',
        'status',
        'dt_order'
    ];


    public function orderProduct() {
        return $this->hasMany(OrderProduct::class, 'id_order');
    }
}
