<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpsShifts extends Model
{
    protected $fillable = [
        'emp_id','shift_id'
    ];


    public function  getEmployee(){

        return $this->hasMany('App\User','id','emp_id');

    }

    public function  getShift(){

        return $this->hasMany('App\Shift','id','shift_id');

    }
}
