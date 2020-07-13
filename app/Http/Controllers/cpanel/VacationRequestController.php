<?php

namespace App\Http\Controllers\cpanel;

use App\Job;
use App\Notifications\VacationsNotifications;
use App\User;
use App\VacationRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class VacationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cpanel.vacationrequest.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
                'from_date' => 'required',
                'to_date' => 'required',
                'reason' => 'required',
                'description' => '',
                'request_date' => '',
                'status' => '',
                'user_id' => '',
                'manager_id' => '',
                'job_id'=>''

            ]);
        $data['description'] = 'طلب اجازه من يوم    ' . request('from_date') . '  الى يوم    ' . \request('to_date');
        $data['request_date'] = $mytime->toDateString();
        $data['user_id'] = Auth::user()->id;


        $job_id = Auth::user()->job_id;
        $data['job_id']=$job_id;

        $manager = Job::where('id', $job_id)->first();

        $manager_id = User::where('job_id', $manager->manager)->first();
        $data['manager_id'] = $manager_id->id;


      $vacation =  VacationRequest::create($data);

        Notification::send($manager_id,new VacationsNotifications($vacation));
        session()->flash('success', trans('admin.vacationrequestsent'));
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
        $vacationRequest = VacationRequest::findOrFail($id);
        return view('cpanel.requests.vacationedit',\compact('vacationRequest'));
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
                'from_date' => '',
                'to_date' => '',
                'reason' => '',
                'description' => '',
                'request_date' => '',
                'status' => '',
                'user_id' => '',
                'manager_id' => '',
                'job_id'=>''

            ]);

        VacationRequest::where('id',$id)->update($data);
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
