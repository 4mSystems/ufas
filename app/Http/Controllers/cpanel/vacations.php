<?php

namespace App\Http\Controllers\cpanel;

 use Illuminate\Http\Request;
 use App\Vacation;
 use App\Http\Controllers\Controller;

class vacations extends Controller
{
    public function vacations()
    {
        $vacations = Vacation::orderBy('id','desc')->first();

        return view('cpanel.vacations.vacations',compact('vacations'));
    }


    public function vacations_save()
    {

        $data = $this->validate(request(),[

            'annual'=>'required|numeric',
            'monthly'=>'required|numeric',
            'daily'=>'required|numeric',

        ]);



//
        Vacation::orderBy('id','desc')->update($data);
        return redirect(url('home'));



    }
}
