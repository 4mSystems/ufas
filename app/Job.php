<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    
    protected $fillable = [
        'name','dept_id', 'enabled' , 'manager'
    ];

    
    public function  getDepartment(){

        return $this->hasOne('App\Department','id','dept_id');
        
    }
    public function  getJob(){

        return $this->hasOne('App\Job','id','manager');

    }
   
}
