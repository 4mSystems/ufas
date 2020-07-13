<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\AskPermission;
use App\VacationRequest;
use App\Department; 
use App\Attendance;
use App\EmpsShifts;
use App\MonthlySummary;
use App\Setting;
use App\Shift;
use App\Shiftsetting;
use App\temp_monthly;
use App\User;
use Carbon\Carbon;
use DateTime;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $emps = User::all()->count();
        $to_dateee = Carbon::now();
             
        $month = $to_dateee->month;
        if($month < 10){
            $month = "0".$month;
        }
        $year = $to_dateee->year;
        $from_dateee = $year."-".$month."-01"; 
        $status = 'accepted';



        $vacationRequest=VacationRequest::where('status',$status)
        ->whereBetween('request_date',[ $from_dateee ,$to_dateee->toDateString()])->count();
     $askpermission=AskPermission::where('status',$status)
            ->whereBetween('request_date',[ $from_dateee ,$to_dateee->toDateString() ])->count();

            $depts = Department::all()->count();


// Monthly report from start of this month til today
            //empty temporary tables 
        temp_monthly::truncate();
        MonthlySummary::truncate();
            //get authintacated user id
        $user_id=auth()->user()->id; 
        //get all user shifts ids.
        $empShiftt = EmpsShifts::where('emp_id', $user_id)->get();


        foreach ($empShiftt as $empshifts) {

            $data = [];
            $data_out = [];
            $time_note = null;
            $time_notes = null;
            $times = null;

            $todate = Carbon::now();
            $month = $todate->month;
            if($month < 10){
                $month = "0".$month;
            }
            $year = $todate->year;
          
            $fromdate = $year."-".$month."-01"; 

            $empShift_id = $empshifts->shift_id;
            $shift_names = Shift::where('id', $empShift_id)->first();

            while ($fromdate <= $todate) {
                $data = [];
                $data_out = [];
                $time_note = null;
                $time_notes = null;
                $times = null;
                $day = new DateTime($fromdate);
                $day = $day->format('l');
                $data['check_date'] = $fromdate;
                $data['shift'] = $shift_names->name;
                $data['day'] = $day;
                $data['user_id']= $user_id;

               $dd =  temp_monthly::create($data);
                   
                $shift_settingss = Shiftsetting::where('shift_id', $shift_names->id)
                    ->where('day', $day)->first();


                $attendances = Attendance::where('check_date', $fromdate)->where('user_id',  $user_id)->get();

                if ($attendances !== null) {

                    $check_in_flag = 0;
                    $check_out_flag = 0;
                    foreach ($attendances as $attendances) {

                        $times = $attendances->check_time;

                        if (strtotime($times) >= strtotime($shift_settingss->start_attendance)
                            && strtotime($times) <= strtotime($shift_settingss->end_attendance)) {

                            if (strtotime($shift_settingss->time_attendance) - strtotime($times) < 0 == true) {


                                $time_note = date('H:i:s', strtotime($times));
                                $data['attendance_delay'] = (new Carbon($time_note))->diff(new Carbon($shift_settingss->time_attendance))->format('%h:%I');
//

                            } elseif (strtotime($shift_settingss->time_attendance) - strtotime($times) > 0 == true) {
                                $time_note = date('H:i:s', strtotime($times));
                                $data['attendance_early'] = (new Carbon($shift_settingss->time_attendance))->diff(new Carbon($time_note))->format('%h:%I');
//

                            }

                            $data['check_in_time'] = $times;


                            $temp = temp_monthly::where('shift', $shift_names->name)->where('check_date', $fromdate)->first();
                            if ($temp->attendance_delay || $temp->attendance_early) {
                                $check_in_flag = 1;
                            } else {
                                $check_in_flag = 0;
                            }
                            if ($check_in_flag != 1) {


                                temp_monthly::where('shift', $shift_names->name)->where('check_date', $fromdate)->update($data);

                            }


                        }
                    }
                }


                //leave process


                $shift_settings = Shiftsetting::where('shift_id', $shift_names->id)
                    ->where('day', $day)->first();

                if ($shift_settings->nextday == 'yes') {

                    $fromdate = new Carbon($fromdate);
                    $fromdate = $fromdate->addDays(1);
                    $fromdate = $fromdate->toDateString();


                }

                $attendance = Attendance::where('check_date', $fromdate)->where('user_id',  $user_id)->get();

                if ($attendance !== null) {

                    foreach ($attendance as $attendance) {

                        $time = $attendance->check_time;


                        if (strtotime($time) >= strtotime($shift_settings->start_leave)
                            && strtotime($time) <= strtotime($shift_settings->end_leave)) {

                            if (strtotime($shift_settings->time_leave) - strtotime($time) < 0 == true) {
                                $time_note = date('H:i:s', strtotime($time));
                                $leave_delay = (new Carbon($time_note))->diff(new Carbon($shift_settingss->time_leave))->format('%h:%I');

                                $data_out['leave_delay'] = $leave_delay;


                            } elseif (strtotime($shift_settings->time_leave) - strtotime($time) > 0 == true) {

                                $time_note = date('H:i:s', strtotime($time));
                                $leave_early = (new Carbon($shift_settings->time_leave))->diff(new Carbon($time_note))->format('%h:%I');

                                $data_out['leave_early'] = $leave_early;


                            }


                            $data_out['check_out_time'] = $time;


//                     return response(['status' => true, 'msg' => $temp_date]);
                        }
                    }
                    if ($shift_settings->nextday == 'yes') {

                        $fromdate = new Carbon($fromdate);

                        $fromdate = $fromdate->subDays(1);
                        $fromdate = $fromdate->toDateString();
                    }
                }
                $temps = temp_monthly::where('shift', $shift_names->name)->where('check_date', $fromdate)->first();

                if ($temps['check_out_time']) {
                    $check_in_flag = 1;
                } else {
                    $check_in_flag = 0;
                }
                if ($check_in_flag != 1) {

                    temp_monthly::where('shift', $shift_names->name)->where('check_date', $fromdate)->update($data_out);

                }

                $no = temp_monthly::where('shift', $shift_names->name)->where('check_date', $fromdate)->first();


                $output = [];
                if ($no->check_in_time == null) {
                    $output['no_attendance'] = 'yes';
                }
                if ($no->check_out_time == null) {
                    $output['no_leave'] = 'yes';
                }
                if ($no->check_out_time == null && $no->check_in_time == null) {
                    $output['no_attendance'] = 'no';
                    $output['no_leave'] = 'no';
                    $output['absences'] = 'yes';
                }
                temp_monthly::where('shift', $shift_names->name)->where('check_date', $fromdate)->update($output);


                $fromdate = new Carbon($fromdate);
                $fromdate = $fromdate->addDays(1);
                $fromdate = $fromdate->toDateString();

            }
        }


        $temp = temp_monthly::orderBy('check_date')->get();
        
        //بيانات جدول الملخص

        //sum attendance delay
        $attendance_delay_sum = temp_monthly::
        selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC( attendance_delay ))) as total')->first();
        $attendance_delay_sum = $attendance_delay_sum->total;
        $attendance_delay_data =[];
        $attendance_delay_data['name'] = 'total_attendance_delay' ;
        $attendance_delay_data['with']= null;
        $attendance_delay_data['without'] = $attendance_delay_sum;
        $attendance_delay_data['total'] = $attendance_delay_sum;
        MonthlySummary::create($attendance_delay_data);

        //sum leave early
        $leave_early_sum = temp_monthly::
        selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC( leave_early ))) as total')->first();
        $leave_early_sum = $leave_early_sum->total;

        $leave_early_data =[];
        $leave_early_data['name'] = 'total_leave_early' ;
        $leave_early_data['with']= null;
        $leave_early_data['without'] = $leave_early_sum;
        $leave_early_data['total'] = $leave_early_sum;

        MonthlySummary::create($leave_early_data);

        //sum attendance early
        $attendance_early_sum = temp_monthly::
        selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC( attendance_early ))) as total')->first();

        $attendance_early_sum = $attendance_early_sum->total;
//
        $attendance_early_data =[];
        $attendance_early_data['name'] = 'total_attendance_early' ;
        $attendance_early_data['with']= null;
        $attendance_early_data['without'] = $attendance_early_sum;
        $attendance_early_data['total'] = $attendance_early_sum;
        MonthlySummary::create($attendance_early_data);

        //sum leave  delay
        $leave_delay_sum = temp_monthly::
        selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC( leave_delay ))) as total')->first();
//        dd($leave_delay_sum);
        $leave_delay_sum = $leave_delay_sum->total;
//
        $leave_delay_data =[];
        $leave_delay_data['name'] = 'leave_delays' ;
        $leave_delay_data['with']= null;
        $leave_delay_data['without'] = $leave_delay_sum;
        $leave_delay_data['total'] = $leave_delay_sum;
        MonthlySummary::create($leave_delay_data);

        $absennce_count = temp_monthly::where('absences', 'yes')->get()->count();

        $absences_data =[];
        $absences_data['name'] = 'absennce_count' ;
        $absences_data['with']= null;
        $absences_data['without'] = $absennce_count;
        $absences_data['total'] = $absennce_count;
        MonthlySummary::create($absences_data);


        $no_attendance_count = temp_monthly::where('no_attendance', 'yes')->get()->count();

        $no_attendance_data =[];
        $no_attendance_data['name'] = 'no_attendance_count' ;
        $no_attendance_data['with']= null;
        $no_attendance_data['without'] = $no_attendance_count;
        $no_attendance_data['total'] = $no_attendance_count;
        MonthlySummary::create($no_attendance_data);

        $no_leave_count = temp_monthly::where('no_leave', 'yes')->get()->count();


        $no_leave_data =[];
        $no_leave_data['name'] = 'no_leave_count' ;
        $no_leave_data['with']= null;
        $no_leave_data['without'] = $no_leave_count;
        $no_leave_data['total'] = $no_leave_count;

        MonthlySummary::create($no_leave_data);

 
            // return response(['status' => true, 'msg' => MonthlySummary::all()]);

            //absennce count 
        $total_absence_h =MonthlySummary::where('id',5)->first('total');
        $no_attendance_count_h = MonthlySummary::where('id',6)->first('total');
        $no_leave_count_h = MonthlySummary::where('id',7)->first('total');
        $total_attendance_delay_h = MonthlySummary::where('id',1)->first('total');
        $total_leave_early_h = MonthlySummary::where('id',2)->first('total');

        $total_overtime_h = MonthlySummary::whereIn('id',[3,4])->
        selectRaw('SEC_TO_TIME(sum(TIME_TO_SEC( total ))) as t')->first();

        $total_overtime_h = $total_overtime_h->t;
  
        // dd($total_absence_h->total);
        //  return response(['status' => true, 'msg' => [$total_overtime_h,$total_absence_h,
        //  $no_attendance_count_h,
        //  $no_leave_count_h,
        //  $total_attendance_delay_h,
        //  $total_leave_early_h]]);



         
        return view('home', compact('emps','vacationRequest','askpermission','depts','total_overtime_h','total_absence_h','no_attendance_count_h','no_leave_count_h','total_attendance_delay_h','total_leave_early_h'));
    }
}
