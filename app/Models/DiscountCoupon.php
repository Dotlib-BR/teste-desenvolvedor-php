<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    protected $fillable = [
        "codigo",
        "tipo",
        "valor",
        "porcento"
    ];
    use HasFactory;
    
    public static function findByCode($code) {
        return self::where('code', $code)->first();
    }
    
    public function desconto($total) {
        if ($this->type == 'fixed'){
            return $this->value;
        } elseif ($this->type == 'percent'){
            return $this->percent / 100 * $total;
        }else {
            return 0;
        }
    }
    public static function findByUser($user) {
        return self::where('user_id', $user)->first();
    }
}