<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'access_level'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}
