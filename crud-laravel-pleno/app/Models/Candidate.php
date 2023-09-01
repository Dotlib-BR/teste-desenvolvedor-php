<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'experience',
        'skills',
        'availability',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
