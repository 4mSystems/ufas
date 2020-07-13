<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excelsheet extends Model
{
    protected $fillable = [
        'dateTime'
    ];

    public function model(array $row)
    {
        return new User([
           'dateTime'     => $row[0], 
        ]);
    }

}
