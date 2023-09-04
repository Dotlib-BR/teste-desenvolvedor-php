<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $dates = ['application_date'];

    protected $fillable = [
        'job_id', 'candidate_id', 'application_date'
    ];

    public function job() {
        return $this->belongsTo(Job::class);
    }

    public function candidate() {
        return $this->belongsTo(Candidate::class);
    }
}
