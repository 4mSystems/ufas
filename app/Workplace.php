<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    protected $fillable = [
        'workplace_name', 'network_name', 'mac_address','notes'];


    public function workplaces()
    {
        return $this->belongsToMany('Workplace', 'empworkplaces');
    }
}
