<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyLink extends Model
{
    use HasFactory;

    protected $table = 'vacancy_links';
    protected $fillable = ['user_id','announcement_id'];

}
