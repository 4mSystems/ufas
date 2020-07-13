<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id','check_date','check_time','image',
    ];
    public function  getUser(){

        return $this->hasOne('App\User','id','user_id');

    }
}
