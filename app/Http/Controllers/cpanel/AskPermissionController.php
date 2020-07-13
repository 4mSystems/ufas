<?php

namespace App\Http\Controllers\cpanel;

use App\AskPermission;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job;
use Carbon\Carbon;
 use Illuminate\Support\Facades\Auth;
use App\Notifications\PermissionsNotifications;
use Illuminate\Support\Facades\Notification;


class AskPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cpanel.askpermission.create');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mytime = Carbon::now();
        $data = $this->validate(\request(),
            [
                'permission_date' => 'required',
                'from' => 'required',
                'to' => 'required',
                'reason' => 'required',
                'description' => '',
                'request_date' => '',
                'status' => '',
                'user_id' => '',
                'manager_id' => '',
                'job_id'=>''

            ]);
        $data['description']  = 'طلب استئذان يوم    ' . request('permission_date') . ' من الساعه   ' . \request('from') . ' الى الساعه  ' . \request('to');
        $data['request_date'] = $mytime->toDateString();
        $data['user_id'] = Auth::user()->id;

        $job_id = Auth::user()->job_id;
        $data['job_id']=$job_id;
        $manager = Job::where('id', $job_id)->first();

        $manager_id = User::where('job_id',$manager->manager)->first();
        $data['manager_id'] = $manager_id->id;

       //dd( $data['request_date'] );
        $permission =   AskPermission::create($data);


        Notification::send($manager_id,new PermissionsNotifications($permission));

        session()->flash('success', trans('admin.permissionrequestsent'));
        return redirect(url('home'));
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
        $permissionAsked=AskPermission::findOrFail($id);

        return view('cpanel.requests.permissionedit',\compact('permissionAsked'));
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
                'permission_date' => '',
                'from' => '',
                'to' => '',
                'reason' => '',
                'description' => '',
                'request_date' => '',
                'status' => 'required',
                'user_id' => '',
                'manager_id' => '',
                'job_id'=>''

            ]);
        AskPermission::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updatedsuccess'));
        return redirect(url('requestslist'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
