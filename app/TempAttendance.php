<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempAttendance extends Model
{
    protected $fillable = [
        'user_id','check_date','check_in_time','check_out_time','shift','notes'
    ];
    public function  getUser(){

        return $this->hasOne('App\User','id','user_id');

    }
}
