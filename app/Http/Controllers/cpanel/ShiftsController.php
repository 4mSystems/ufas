<?php

namespace App\Http\Controllers\cpanel;

use App\Shift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shiftsetting;
class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::all();
        return view('cpanel.shifts.index', compact('shifts'));
    }


    public function create()
    {
        return view('cpanel.shifts.create');
    }


    public function store(Request $request)
    {
        $data=$this->validate(\request(),
            [
                'name'=>'required|unique:shifts',
                'delayallowed'=>'required',
                'leaveallowed'=>'required',

            ]);




         $shifts =  Shift::create($data);
         $shifts->save();


         //add 7 rows to shiftSettings (sat , sun , mon ,.....)
         $shift_id = $shifts->id;

        $data = array(
            array('shift_id'=>$shift_id, 'day'=>'Saturday'),
            array('shift_id'=>$shift_id, 'day'=>'Sunday'),
            array('shift_id'=>$shift_id, 'day'=>'Monday'),
            array('shift_id'=>$shift_id, 'day'=>'Tuesday'),
            array('shift_id'=>$shift_id, 'day'=>'Wednesday'),
            array('shift_id'=>$shift_id, 'day'=>'Thursday'),
            array('shift_id'=>$shift_id, 'day'=>'Friday'),

        );

        Shiftsetting::insert($data);



        session()->flash('success',trans('admin.addedsuccess'));
        return redirect(url('shifts'));
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shifts=Shift::findOrFail($id);
        return view('cpanel.shifts.edit',compact('shifts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$this->validate(\request(),
            [
                'name'=>'required|unique:shifts,name,'.$id,

                'delayallowed'=>'required',
                'leaveallowed'=>'required',


            ]);


        Shift::where('id',$id)->update($data);

        session()->flash('success',trans('admin.updatedsuccess'));
        return redirect(url('shifts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift =  Shift::find($id);
        $shift->delete();

        session()->flash('success',trans('admin.deleted'));
        return redirect(url('shifts'));
    }
}
