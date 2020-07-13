<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job;
use App\Department;
use App\User;
use Auth;
use App\Permission;
class JobsController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $permission = Permission::where('user_id',$user_id)->first();
            $enabled =  $permission->jobsPage;
            if($enabled == 'yes'){  

        $departments =  Department::all(); 
        $jobs=Job::all(); 
       
        return view('cpanel.jobs.index',\compact('jobs','departments'));
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
            $enabled =  $permission->jobsPage;
            if($enabled == 'yes'){  
        $departments =  Department::all();
        $manager = Job::where('enabled','yes')->get();
       
        return view('cpanel.jobs.create',compact('departments','manager'));
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
            'name'=>'required|unique:jobs',
            'dept_id'=>'numeric',
            'manager'=>'',
            'enabled'=>'required'
            

        ],[],[ 
            'name'=>'Name'
        ]);
 

        
             
        Job::create($data);
        session()->flash('success',trans('admin.addedsuccess'));
        return redirect(url('jobs'));
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
            $enabled =  $permission->jobsPage;
            if($enabled == 'yes'){  
       
        $job=Job::findOrFail($id);
        //dd($job);
 

        $departments = Department::pluck('name','id'); 
         $managers = Job::where("id",$job->manager)->first();
        $manager = Job::where('enabled','yes')->get();
                    //   dd($manager);
      
        return view('cpanel.jobs.edit',\compact('departments','manager','job','managers'));
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
            'name'=>'required|unique:jobs,name,'.$id,
            'dept_id'=>'required|numeric',
            'manager'=>'',
            'enabled'=>'required'
      
        ]);
  
       
        Job::where('id',$id)->update($data);
        session()->flash('msg',trans('admin.updatedsuccess'));
        return redirect(url('jobs'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 1){
            session()->flash('errors',trans('admin.admindeleteerror'));
            return redirect(url('jobs'));
        }
        $Job =  Job::find($id);
        $jobs = Job::where('manager',$id)->update(array('manager' => 1));
    //    $jobs->save();
       
      
        $Job->delete();

           session()->flash('success',trans('admin.departmentdeleted'));
           return redirect(url('jobs'));  
    }
}
