<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empworkplaces extends Model
{
    protected $fillable = [
        'emp_id','workplace_id'
    ];


    public function  getEmployee(){

        return $this->hasMany('App\User','id','emp_id');

    }

    public function  getWorkPlace(){

        return $this->hasMany('App\Workplace','id','workplace_id');

    }
}
