<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shiftsetting extends Model
{
    protected $fillable = [
        'shift_id', 'day', 'time_attendance','start_attendance','end_attendance','time_leave','start_leave',
        'end_leave','vacation','nextday'
    ];


    public function  getShift(){

        return $this->hasOne('App\Shift','id','shift_id');

    }
}
