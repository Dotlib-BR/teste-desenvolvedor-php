<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'type', 'status'
    ];

    public function user() {
        // Se a chave estrangeira for diferente de user_id, você precisa especificar: 
        // return $this->belongsTo(User::class, 'sua_chave_externa');
        return $this->belongsTo(User::class);
    }

    public function candidates() {
        return $this->belongsToMany(Candidate::class, 'applications')->withPivot('application_date');
    }
}
