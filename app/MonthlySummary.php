<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlySummary extends Model
{
    protected $fillable = [
        'name' ,
        'with',
        'without',
        'total',
    ];
}
