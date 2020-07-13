<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class temp_monthly extends Model
{

    protected $fillable = [
        'check_date' ,
        'shift',
        'day',
        'attendance_delay',
        'leave_early',
        'attendance_early',
        'leave_delay',
        'no_attendance',
        'no_leave',
        'absences',
        'check_in_time',
        'check_out_time',
        'user_id'
    ];

    public function  getUser(){

        return $this->hasOne('App\User','id','user_id');

    }
}
