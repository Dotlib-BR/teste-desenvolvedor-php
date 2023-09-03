<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'experience', 'skills', 'availability'
    ];

    public function jobs() {
        return $this->belongsToMany(Job::class, 'applications')->withPivot('application_date');
    }
}
