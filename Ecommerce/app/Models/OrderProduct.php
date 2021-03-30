<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_products';

        /**
     * Desabilitando o auto timestamp
     *
     */
    public $timestamps = false;

    /**
     * Atributos que podem ser atribuidos
     *
     * @var array
     */
    protected $fillable = [
        'id_order',
        'id_product',
        'quantity',
        'price'
    ];

    public function order()
	{
		return $this->belongsTo(Order::class, 'id_order');
	}

    public function product(){
        return $this->belongsTo(Product::class, 'id_product');
    }
}
