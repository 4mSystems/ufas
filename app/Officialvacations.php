<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officialvacations extends Model
{
    protected $fillable = [
        'name', 'vacation_date', 'notes'
    ];
}
