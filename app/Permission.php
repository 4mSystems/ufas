<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'user_id',
        'overtimePage',
        'jobsPage',
        'employeePage',
        'departmentPage',
        'permissionPage',
        'archievesEdit',
          'vacations',
        'workplaces',
        'officialvacations',
        'shifts',
        'settings',
        'Archievs',
        'dailyreport',
        'mothlyreport',
    ];


    public function getUser()
    {

        return $this->hasOne('App\User', 'id', 'user_id');

    }
}
