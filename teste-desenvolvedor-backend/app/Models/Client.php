<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method create(array $attributes)
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
