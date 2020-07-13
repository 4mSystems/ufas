<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonuses extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','overtime','late','early','notsign','absence'
    ];

    
}
