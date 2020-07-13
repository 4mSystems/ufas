<?php

namespace App\Http\Controllers\cpanel;

use App\Shift;
use App\Shiftsetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShiftSettingsController extends Controller
{
    public function viewShiftSettings($id)
    {

        $shiftSettings = Shiftsetting::where('shift_id', $id)->get();
        $shiftName = Shift::where('id',$id)->first();

        return view('cpanel.shiftsettings.index', compact('shiftSettings','shiftName'));

    }

    public function edit($id)
    {
        $shiftsetting = Shiftsetting::findOrFail($id);
        $shift_id = $shiftsetting->shift_id;
        //dd($shift_id);
        $shiftName = Shift::where('id',$shift_id)->first();
        return view('cpanel.shiftsettings.edit', compact('shiftsetting','shiftName'));


    }


    public function update(Request $request, $id)
    {

        $data=$this->validate(\request(),
            [
                //|date_format:H:i|after:time_attendance
                'time_attendance'=>'required',
                'start_attendance'=>'required',
                'end_attendance'=>'required',
                'time_leave'=>'required',
                'start_leave'=>'required',
                'end_leave'=>'required',
                'vacation'=>'required|in:yes,no',
                'nextday'=>'required|in:yes,no',

            ]);

       $addAll =  $request->addAll;



        if($addAll == 'no') {


            Shiftsetting::where('id', $id)->update($data);
            $shiftsetting = Shiftsetting::where('id', $id)->first();


            session()->flash('msg', trans('admin.updatedsuccess'));
            return redirect(url('shiftsettings/' . $shiftsetting->shift_id));
        }
        else{
            Shiftsetting::where('id', $id)->first();
            $shiftsetting = Shiftsetting::where('id', $id)->first();
            $shift_id = $shiftsetting->shift_id;
            $shift_days = Shiftsetting::where('shift_id',$shift_id)->update($data);


            session()->flash('msg', trans('admin.updatedsuccess'));
            return redirect(url('shiftsettings/' . $shiftsetting->shift_id));
        }

    }
}
