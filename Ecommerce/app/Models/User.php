<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

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
        'name',
        'last_name',
        'document',
        'email',
        'password',
        'avatar'
    ];


    /**
     * Atributos que devem ser escondidos
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
