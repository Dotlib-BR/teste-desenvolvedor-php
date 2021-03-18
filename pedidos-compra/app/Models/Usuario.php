<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class Usuario extends Authenticable
{

    use Notifiable, HasApiTokens;



    protected $fillable = array('nome', 'email', 'password');

    protected $hidden = array('password', 'remember_token');



}
