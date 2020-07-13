<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Workplace;
class WorkplaceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $workplaces=Workplace::all();

        return view('cpanel.workplace.index',compact('workplaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cpanel.workplace.create');
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
                'workplace_name'=>'required|unique:workplaces',
                'network_name'=>'required',
                'mac_address'=>'required',
                'notes'=>'required',
            ]);

                    


       $result =  Workplace::create($data);
       
        session()->flash('success',trans('admin.addedsuccess'));
        return redirect(url('workplaces'));
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
        $workplace=Workplace::findOrFail($id);
        return view('cpanel.workplace.edit',\compact('workplace'));
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
                'workplace_name'=>'required|unique:workplaces,workplace_name,'.$id,
                'network_name'=>'required',
                'mac_address'=>'required',
                'notes'=>'required',

            ]);


        Workplace::where('id',$id)->update($data);

        session()->flash('success',trans('admin.updatedsuccess'));
        return redirect(url('workplaces'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workplace =  Workplace::find($id);
        $workplace->delete();

        session()->flash('errors',trans('admin.deleted'));
        return redirect(url('workplaces'));
    }
}
