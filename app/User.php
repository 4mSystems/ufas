<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','address','salary','job_id',
        'dept_id','bonuses_id','work_hour'
    ];


    public function  getDepartment(){

        return $this->hasOne('App\Department','id','dept_id');
        
    }

    public function  getJob(){

        return $this->hasOne('App\Job','id','job_id');
        
    }

    public function  getBonuses(){

        return $this->hasOne('App\Bonuses','id','bonuses_id');
        
    }

    public function employees()
    {
        return $this->belongsToMany('User', 'empworkplaces');
    }

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
