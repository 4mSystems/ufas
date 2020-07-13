<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use Auth;
use App\Permission;
class DepartmentsController extends Controller
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

        $user_id=auth()->user()->id;
        $permission = Permission::where('user_id',$user_id)->first();
            $enabled =  $permission->departmentPage;
            if($enabled == 'yes'){
        $departments =Department::all(); 
        return view('cpanel.departments.department' , \compact('departments'));
    }else{

        return redirect(url('home'));
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id=auth()->user()->id;
        $permission = Permission::where('user_id',$user_id)->first();
            $enabled =  $permission->departmentPage;
            if($enabled == 'yes'){
        return view('cpanel.departments.create');   
    }else{

        return redirect(url('home'));
    }
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
            'name'=>'required|unique:departments'
            

        ],[],[ 
            'name'=>'Name'
        ]);
 

  
             
        Department::create($data);
        session()->flash('success',trans('admin.addedsuccess'));
        return redirect(url('departments'));
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
            $enabled =  $permission->departmentPage;
            if($enabled == 'yes'){
        $department=Department::findOrFail($id);
       
        return view('cpanel.departments.edit',compact('department'));
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
            'name'=>'required|unique:departments,name,'.$id   , 
        ],[],[ 
            
        ]); 
        Department::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updatedsuccess'));
        return redirect(url('departments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         
        $department =  Department::find($id);
         $department->delete();

            session()->flash('success',trans('admin.departmentdeleted'));
            return redirect(url('departments'));  
    }
}
