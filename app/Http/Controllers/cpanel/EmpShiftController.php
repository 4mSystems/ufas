<?php

namespace App\Http\Controllers\cpanel;

use App\EmpsShifts;
use App\empworkplaces;
use App\Shift;
use App\User;
use App\Workplace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpShiftController extends Controller
{
    public function getAllShifts($id)
    {
        $emp = User::find($id);
        $old_shifts =EmpsShifts::where('emp_id',$id)->pluck('shift_id')->toArray();


        $shifts = Shift::all();
        return view('cpanel.employee.empshifts', compact('shifts', 'emp','old_shifts'));


    }

    public function setShifts(Request $request, $id)
    {
        $emp = User::find($id);
        $data = $request->input('shifts');

        $empshifts = EmpsShifts::where('emp_id', $id);
        if ($empshifts != null) {
            $empshifts->delete();
        }
        if ($data != null) {
            foreach ($data as $data) {
                EmpsShifts::create(['emp_id' => $emp->id, 'shift_id' => $data]);

            }
        }
//            dd($data);
        session()->flash('msg', trans('admin.updatedsuccess'));
        return redirect(url('employee'));


//       $door->colors()->sync(Input::get('colors'));

    }
}
