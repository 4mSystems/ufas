<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $fillable = [
        'annual', 'monthly', 'daily'
    ];
}
