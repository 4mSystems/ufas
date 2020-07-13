<?php

namespace App\Http\Controllers\cpanel;

use App\Officialvacations;
 use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficialvacationsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $officialvacations=Officialvacations::all();

        return view('cpanel.officialvacations.index',compact('officialvacations'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.officialvacations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$this->validate(\request(),
            [
                'name'=>'required|unique:officialvacations',
                'vacation_date'=>'required',
                'notes'=>'',
            ]);


        Officialvacations::create($data);
        session()->flash('success',trans('admin.addedsuccess'));
        return redirect(url('officialvacations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vacations=Officialvacations::findOrFail($id);
        return view('cpanel.officialvacations.edit',\compact('vacations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$this->validate(\request(),
            [
                'name'=>'required|unique:officialvacations,name,'.$id,
                'vacation_date'=>'required',
                'notes'=>'',

            ]);


        Officialvacations::where('id',$id)->update($data);

        session()->flash('success',trans('admin.updatedsuccess'));
        return redirect(url('officialvacations'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacation =  Officialvacations::find($id);
        $vacation->delete();

        session()->flash('success',trans('admin.deleted'));
        return redirect(url('officialvacations'));
    }
}
