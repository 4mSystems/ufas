<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        
        $user_id=auth()->user()->id;
        $permission = Permission::where('user_id',$user_id)->first();
            $enabled =  $permission->permissionPage;
            if($enabled == 'yes'){  
       
         $permission = Permission::where('user_id',$id)->first();
          
         return view('cpanel.permission.permission',\compact('permission'));
        }else{

            return redirect(url('home'));
        }
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
            'overtimePage'=>'required|in:yes,no', 
            'jobsPage'=>'required|in:yes,no',
            'employeePage'=>'required|in:yes,no',
            'departmentPage'=>'',
            'permissionPage'=>'required|in:yes,no',
            'archievesEdit'=>'required|in:yes,no',
            'vacations'=>'required|in:yes,no',
            'workplaces'=>'required|in:yes,no',
            'officialvacations'=>'required|in:yes,no',
            'shifts'=>'required|in:yes,no',
            'settings'=>'required|in:yes,no',
            'Archievs'=>'required|in:yes,no',
            'dailyreport'=>'required|in:yes,no',
            'mothlyreport'=>'required|in:yes,no',
        ],[],[ 
            
        ]); 
        Permission::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updatedsuccess'));
        return redirect(url('employee'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
