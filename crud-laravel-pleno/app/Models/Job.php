<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'type', 'status', 'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function candidates() {
        return $this->belongsToMany(Candidate::class, 'applications')->withPivot('application_date');
    }
}
