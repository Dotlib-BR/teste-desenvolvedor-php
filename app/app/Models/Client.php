<?php

namespace App\Models;

use App\Contracts\AdvancedSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Client extends Model implements AdvancedSearchable
{
    use HasFactory;

    protected $guarded = ['id'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public static function scopeAdvancedSearch($query, $param)
    {
        return $query->where('name', 'like', "%$param%")
            ->orWhere('cpf', 'like', "%$param%")
            ->orWhere('email', 'like', "%$param%");
    }

    public function listedFormat()
    {
        return $this->name;
    }

    public function displayResultFormat()
    {
        return $this->name;
    }
     
    public function resultFormat()
    {
        return $this->id;
    }
}
