<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'products';

    /**
     * Desabilitando o auto timestamp
     *
     */
    public $timestamps = false;

    /**
     * Atributos que botem ser atribuidos
     *
     * @var array
     */
    protected $fillable = [
        'name_product',
        'price',
        'code',
        'discount',
        'discount_status',
        'product_image'

    ];

    public function productOrder() {
        return $this->hasMany(OrderProduct::class, 'id_product');
    }
}
