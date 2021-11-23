<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','title','description','remuneration','vacancy_type' ,'active'];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
