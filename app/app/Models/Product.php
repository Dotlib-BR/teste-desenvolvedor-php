<?php

namespace App\Models;

use App\Contracts\AdvancedSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model implements AdvancedSearchable
{
    use HasFactory;

    protected $guarded = ['id'];

    public function orderProduct(): BelongsToMany
    {
        return $this->belongsToMany(OrderProduct::class);
    }

    public static function scopeAdvancedSearch($query, $param)
    {
        return $query->where('name', 'like', "%$param%")
            ->orWhere('barcode', 'like', "%$param%");
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
