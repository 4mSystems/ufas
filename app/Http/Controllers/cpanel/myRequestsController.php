<?php

namespace App\Http\Controllers\cpanel;

use App\AskPermission;
use App\VacationRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class myRequestsController extends Controller
{
    public function index()
    {
        $to_date = Carbon::now();
        $month = $to_date->month;
        if($month < 10){
            $month = "0".$month;
        }
        $year = $to_date->year;
        $from_date = $year."-".$month."-01";
//       dd($to_date);

        $user_id = Auth::user()->id;
        $askpermission=AskPermission::where('user_id',$user_id)
            ->whereBetween('request_date',[ $from_date ,$to_date->toDateString() ])->get();

        $vacationRequest=VacationRequest::where('user_id',$user_id)
            ->whereBetween('request_date',[ $from_date ,$to_date->toDateString() ])->get();

        return view('cpanel.myrequests.index',compact('askpermission','vacationRequest'));

    }

    public function store(Request $request)
    {

        $from_date = $request['filter_from'];
        $to_date   =$request['filter_to'];
//        dd($to_date);
        $user_id = Auth::user()->id;

        if($from_date == null || $to_date == null){
            $askpermission=AskPermission::where('user_id',$user_id)->get();

            $vacationRequest=VacationRequest::where('user_id',$user_id)->get();
            return view('cpanel.myrequests.index',compact('askpermission','vacationRequest'));

        }else {
            $askpermission = AskPermission::where('user_id', $user_id)
                ->whereBetween('request_date', [$from_date, $to_date])->get();

            $vacationRequest = VacationRequest::where('user_id', $user_id)
                ->whereBetween('request_date', [$from_date, $to_date])->get();

            return view('cpanel.myrequests.index', compact('askpermission', 'vacationRequest'));
        }
    }

}
