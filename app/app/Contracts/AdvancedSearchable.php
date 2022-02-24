<?php

namespace App\Contracts;

interface AdvancedSearchable
{
    public static function scopeAdvancedSearch($query, $param);

    public function listedFormat();

    public function displayResultFormat();     
}