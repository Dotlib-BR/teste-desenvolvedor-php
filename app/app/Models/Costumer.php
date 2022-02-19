<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'cpf',
    ];

    protected $appends = ['picture'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getPictureAttribute()
    {
        return 'https://avatars.dicebear.com/api/micah/' . $this->email . '.svg';
    }
}
