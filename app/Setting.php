<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'logo', 'system_name_ar', 'system_name_en','contacts'
    ];
}
