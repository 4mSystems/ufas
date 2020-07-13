<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Job;
use Form;
use App\Permission;
use Auth;
use App\AskPermission;
use App\VacationRequest;
class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $permission = Permission::where('user_id', $user_id)->first();
        $enabled = $permission->employeePage;
        if ($enabled == 'yes') {
            $employees = User::all();
            return view('cpanel.employee.index', \compact('employees'));
        } else {
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
        $user_id = auth()->user()->id;
        $permission = Permission::where('user_id', $user_id)->first();
        $enabled = $permission->employeePage;
        if ($enabled == 'yes') {


            if (request()->ajax()) {
                if (request()->has('dept_id')) {
                    $emp_job_id = User::get('job_id');

                    $select = request()->has('select') ? request('select') : '';

                    $job = Job::whereNotIn('id', $emp_job_id)->where('dept_id', request('dept_id'))
                        ->pluck('name', 'id');

                    return Form::select('job_id', $job, $select
                        , ["class" => "form-control", 'placeholder' => trans('admin.chooseJob')]);
                }
            }

            return view('cpanel.employee.create');
        } else {
            return redirect(url('home'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:users',
                'mobile' => 'numeric|required|unique:users',
                'address' => 'nullable',
                'salary' => 'required|numeric',
                'job_id' => 'required|numeric|unique:users',
                'dept_id' => 'required|numeric',
                'bonuses_id' => 'required|numeric',
                'email' => 'nullable',
                'work_hour' => 'required|numeric',
                'password' => 'required|min:6'


            ], [], [
                'name' => 'Name'
            ]);
        $data['password'] = bcrypt(request('password'));

        $user = User::create($data);
        $user->save();


        $user_id = $user->id;


        $permissions['user_id'] = $user_id;
        $per = Permission::create($permissions);
        $per->save();

        session()->flash('success', trans('admin.addedsuccess'));
        return redirect(url('employee'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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

        $user_id = auth()->user()->id;
        $permission = Permission::where('user_id', $user_id)->first();
        $enabled = $permission->employeePage;
        if ($enabled == 'yes') {

            $employee = User::findOrFail($id);

            if (request()->ajax()) {
                if (request()->has('dept_id')) {
                    $emp_job_id = User::where('id','!=',$id)->get('job_id');

                    $select = request()->has('select') ? request('select') : '';

                    $job = Job::whereNotIn('id', $emp_job_id)->where('dept_id', request('dept_id'))
                        ->pluck('name', 'id');

                    return Form::select('job_id', $job, $select
                        , ["class" => "form-control", 'placeholder' => trans('admin.chooseJob')]);
                }
            }
            return view('cpanel.employee.edit', \compact('employee'));
        } else {
            return redirect(url('home'));
        }
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

        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:users,name,' . $id,
                'mobile' => 'numeric|required|unique:users,mobile,' . $id,
                'address' => 'nullable',
                'salary' => 'required|numeric',
                'job_id' => 'required|numeric|unique:users,job_id,' . $id,
                'dept_id' => 'required|numeric',
                'bonuses_id' => 'required|numeric',
                'email' => 'nullable',
                'work_hour' => 'required|numeric',


            ], [], [
                'name' => 'Name'
            ]);

        User::where('id', $id)->update($data);
        session()->flash('success', trans('admin.addedsuccess'));
        return redirect(url('employee'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id!=1) {
            $employee = User::find($id);
            
            AskPermission::where('user_id',$id)->delete();
            VacationRequest::where('user_id',$id)->delete();

            $allnotify = auth()->user()->unreadNotifications;

    foreach($allnotify as $notify)
    {
        
            $id=$notify->data['user_id'];

            if($id == $employee->name)
            {
                $notify->markAsRead();
            }
        
    }
    $employee->delete();
        session()->flash('success', trans('admin.departmentdeleted'));
        }
        else{

            session()->flash('errors', trans('admin.admindeleteerror'));
            return redirect(url('employee'));

        }
        return redirect(url('employee'));

    }
}
