<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'admin';

    protected $guard = 'admin';

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
        'email',
        'password',
        'admin_avatar'
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
