<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacationRequest extends Model
{
    protected $fillable = [
        'from_date',
        'to_date',
        'reason',
        'description',
        'request_date',
        'status',
        'user_id',
        'manager_id',
        'job_id'
    ];

    public function getUser()
    {

        return $this->hasOne('App\User', 'id', 'user_id');

    }

    public function getManager()
    {

        return $this->hasOne('App\User', 'id', 'manager_id');

    }
    public function  getJob(){

        return $this->hasOne('App\Job','id','job_id');

    }
}
