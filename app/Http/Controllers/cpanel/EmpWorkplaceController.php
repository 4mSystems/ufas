<?php

namespace App\Http\Controllers\cpanel;

use App\empworkplaces;
use App\User;
use App\Workplace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpWorkplaceController extends Controller
{
    public function getAllWorkPlaces($id)
    {
        $emp = User::find($id);
        $old_workplaces =empworkplaces::where('emp_id',$id)->pluck('workplace_id')->toArray();
        $workplaces = Workplace::all();
        return view('cpanel.employee.empworkplace', compact('workplaces', 'emp','old_workplaces'));


    }



    public function setWorkPlaces(Request $request, $id)
    {
        $emp = User::find($id);
        $data = $request->input('workplaces');


        $empworkplacess = empworkplaces::where('emp_id', $id);
        if ($empworkplacess != null) {
            $empworkplacess->delete();
        }
        if ($data != null) {
            foreach ($data as $workplaces) {
                //will try delete all and
                empworkplaces::create(['emp_id' => $emp->id, 'workplace_id' => $workplaces]);

            }
        }
//            dd($data);
        session()->flash('msg', trans('admin.updatedsuccess'));
        return redirect(url('employee'));


//       $door->colors()->sync(Input::get('colors'));

    }
}
