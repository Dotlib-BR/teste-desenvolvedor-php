<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name', 
        'email',
        'cpf',
    ];

    /**
     * Get the user record associated with the client.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAllOrderByName(Type $var = null)
    {
        return $this->orderBy('name')
            ->get();
    }

    /**
     * Get the formated client's cpf.
     *
     * @return string
     */
    public function getCpfFullAttribute()
    {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $this->cpf);
    }
}
