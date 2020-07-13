<?php

namespace App\Http\Controllers\cpanel;

use App\Attendance;
use App\EmpsShifts;
use App\Setting;
use App\Shiftsetting;
use App\TempAttendance;
use App\User;
use App\Shift;

//use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;

use PDF;

class DailyReportController extends Controller
{

    public function index()
    {
        TempAttendance::truncate();
//        foreach ($temp as $temp) {
//            $temp->delete();
//
//        }

        $users = User::all();
        $employee = "all";
        // loop for users
        foreach ($users as $user) {

            $todaye_date = Carbon::now();
            $todaye_date = $todaye_date->toDateString();
            $daye = new DateTime($todaye_date);
            $daye = $daye->format('l');


            $empShiftt = EmpsShifts::where('emp_id', $user->id)->get();
            foreach ($empShiftt as $empShiftt) {
                $empShift_id = $empShiftt->shift_id;
                $shift_settingss = Shiftsetting::where('shift_id', $empShift_id)
                    ->where('day', $daye)->get();

                foreach ($shift_settingss as $shift_settingss) {


                    $attendances = Attendance::where('check_date', $todaye_date)->where('user_id', $user->id)->get();
                    if ($attendances !== null) {
                        $check_in_flag = 0;
                        $check_out_flag = 0;
                        foreach ($attendances as $attendances) {

                            $times = $attendances->check_time;
                            if (strtotime($times) >= strtotime($shift_settingss->start_attendance)
                                && strtotime($times) <= strtotime($shift_settingss->end_attendance)) {
                                if (strtotime($shift_settingss->time_attendance) - strtotime($times) <= 0 == true) {


                                    $time_note = date('H:i:s', strtotime($times));
                                    $delays = (new Carbon($time_note))->diff(new Carbon($shift_settingss->time_attendance))->format('%h:%I');


                                    $notes = " حضور متاخر  " . $delays;


                                } elseif (strtotime($shift_settingss->time_attendance) - strtotime($times) > 0 == true) {
                                    $time_note = date('H:i:s', strtotime($times));
                                    $delays = (new Carbon($shift_settingss->time_attendance))->diff(new Carbon($time_note))->format('%h:%I');

                                    $notes = " حضور مبكر  " . $delays;

                                }
                                $shift_idd = $shift_settingss->shift_id;
                                $shifts = Shift::where('id', $shift_idd)->first();
                                $shift_names = $shifts->name;

                                $data['check_date'] = $attendances->check_date;
                                $data['check_in_time'] = $times;
                                $data['shift'] = $shift_names;
                                $data['user_id'] = $attendances->user_id;
                                $data['notes'] = $notes;


                                //create table to store data temporary
                                $previous_temp = TempAttendance::where('shift', $shift_names)->where('user_id', $user->id)->first();

                                if ($previous_temp) {
                                    $check_in_flag = 1;
                                } else {
                                    $check_in_flag = 0;
                                }
                                if ($check_in_flag != 1) {


                                    TempAttendance::create($data);
                                }
                            }
                        }
                    }
                }
            }


        }
//
//        $temp_date = TempAttendance::where('check_date', $todaye_date)->orderBy('shift', "desc")->get();
//
//        $emp = User::all();
//        return response(['status' => true, 'msg' => $temp_date]);


        foreach ($users as $user) {

            $today_date = Carbon::now();
            $today_date = $today_date->toDateString();
            $day = new DateTime($today_date);
            $day = $day->format('l');

            $empShift = EmpsShifts::where('emp_id', $user->id)->get();
            foreach ($empShift as $empShift) {
                $empShift_id = $empShift->shift_id;
                $shift_settings = Shiftsetting::where('shift_id', $empShift_id)
                    ->where('day', $day)->get();

                foreach ($shift_settings as $shift_setting) {

                    if ($shift_setting->nextday == 'yes') {
                        $today_date = Carbon::now();
                        $today_date = $today_date->addDays(1);
                        $today_date = $today_date->toDateString();
                        $day = new DateTime($today_date);
                        $day = $day->format('l');


                    }


                    $attendance = Attendance::where('check_date', $today_date)->where('user_id', $user->id)->get();

                    if ($attendance !== null) {

                        foreach ($attendance as $attendance) {

                            $time = $attendance->check_time;


                            if (strtotime($time) >= strtotime($shift_setting->start_leave)
                                && strtotime($time) <= strtotime($shift_setting->end_leave)) {

                                if (strtotime($shift_setting->time_leave) - strtotime($time) <= 0 == true) {
                                    $time_note = date('H:i:s', strtotime($time));
                                    $delay = (new Carbon($time_note))->diff(new Carbon($shift_setting->time_leave))->format('%h:%I');


                                    $notes_out = ' / ' . " انصراف متاخر  " . $delay;

                                } elseif (strtotime($shift_setting->time_leave) - strtotime($time) > 0 == true) {

                                    $time_note = date('H:i:s', strtotime($time));
                                    $delay = (new Carbon($shift_setting->time_leave))->diff(new Carbon($time_note))->format('%h:%I');

                                    $notes_out = ' / ' . " انصراف مبكر  " . $delay;


                                }
                                $shift_id = $shift_setting->shift_id;
                                $shift = Shift::where('id', $shift_id)->first();
                                $shift_name = $shift->name;


                                $data_out['check_out_time'] = $time;
                                if ($shift_setting->nextday == 'yes') {
                                    $today_date = Carbon::now();
                                    $today_date = $today_date->toDateString();

                                }


                                $dd = TempAttendance::where('check_date', $today_date)->where('shift', $shift_name)->where('user_id', $user->id)->first();
                                if ($dd === null) {
                                    $data_out['shift']= $shift_name;
                                    $data_out['check_date']= $today_date;
                                    $data_out['user_id']= $user->id;
                                    $data_out['notes'] = '   لم يتم تسجيل حضور ' . $notes_out;


                                    TempAttendance::create($data_out);

                                    $data_out = null;

                                } else {
                                    $data_out['notes'] = $dd->notes . '' . $notes_out;
                                    TempAttendance::where('check_date', $today_date)->where('shift', $shift_name)->where('user_id', $user->id)->update($data_out);

                                }

                                }
                        }
                    }
                }


            }
        }


        $temp_date = TempAttendance::all();

        $emp = User::all();
//        return response(['status' => true, 'msg' => $temp_date]);
        $today_datee = Carbon::now();
        $today_datee = $today_datee->toDateString();
        return view('cpanel.reports.dailyreport', compact('temp_date', 'emp','employee','today_datee'));

    }




    public function store(Request $request)
    {


        TempAttendance::truncate();
        if ($request['reportdate'] == null) {

            $today_date = Carbon::now();
            $today_date = $today_date->toDateString();
            $report_date = $today_date;
        } else {

            $report_date = $request['reportdate'];
            $today_date = $report_date;
        }



        if ($request['user'] == 'all') {
            $employee = "all";
            $users = User::all();
            foreach ($users as $user) {

                $todaye_date = $report_date;
                $todaye_date = new Carbon($todaye_date);
                $todaye_date = $todaye_date->toDateString();
                $daye = new DateTime($todaye_date);
                $daye = $daye->format('l');


                $empShiftt = EmpsShifts::where('emp_id', $user->id)->get();
                foreach ($empShiftt as $empShiftt) {
                    $empShift_id = $empShiftt->shift_id;
                    $shift_settingss = Shiftsetting::where('shift_id', $empShift_id)
                        ->where('day', $daye)->get();

                    foreach ($shift_settingss as $shift_settingss) {


                        $attendances = Attendance::where('check_date', $todaye_date)->where('user_id', $user->id)->get();
                        if ($attendances !== null) {
                            $check_in_flag = 0;
                            $check_out_flag = 0;
                            foreach ($attendances as $attendances) {

                                $times = $attendances->check_time;
                                if (strtotime($times) >= strtotime($shift_settingss->start_attendance)
                                    && strtotime($times) <= strtotime($shift_settingss->end_attendance)) {
                                    if (strtotime($shift_settingss->time_attendance) - strtotime($times) <= 0 == true) {


                                        $time_note = date('H:i:s', strtotime($times));
                                        $delays = (new Carbon($time_note))->diff(new Carbon($shift_settingss->time_attendance))->format('%h:%I');


                                        $notes = " حضور متاخر  " . $delays;


                                    } elseif (strtotime($shift_settingss->time_attendance) - strtotime($times) > 0 == true) {
                                        $time_note = date('H:i:s', strtotime($times));
                                        $delays = (new Carbon($shift_settingss->time_attendance))->diff(new Carbon($time_note))->format('%h:%I');

                                        $notes = " حضور مبكر  " . $delays;

                                    }
                                    $shift_idd = $shift_settingss->shift_id;
                                    $shifts = Shift::where('id', $shift_idd)->first();
                                    $shift_names = $shifts->name;

                                    $data['check_date'] = $attendances->check_date;
                                    $data['check_in_time'] = $times;
                                    $data['shift'] = $shift_names;
                                    $data['user_id'] = $attendances->user_id;
                                    $data['notes'] = $notes;


                                    //create table to store data temporary
                                    $previous_temp = TempAttendance::where('shift', $shift_names)->where('user_id', $user->id)->first();

                                    if ($previous_temp) {
                                        $check_in_flag = 1;
                                    } else {
                                        $check_in_flag = 0;
                                    }
                                    if ($check_in_flag != 1) {


                                        TempAttendance::create($data);
                                    }
                                }
                            }
                        }
                    }
                }


            }
////
//        $temp_date = TempAttendance::where('check_date', $todaye_date)->orderBy('shift', "desc")->get();
//
//        $emp = User::all();
//        return response(['status' => true, 'msg' => $temp_date]);


            foreach ($users as $user) {

                $today_date = $report_date;
                $today_date = new Carbon($today_date);
                $today_date = $today_date->toDateString();
                $day = new DateTime($today_date);
                $day = $day->format('l');


                $empShift = EmpsShifts::where('emp_id', $user->id)->get();
                foreach ($empShift as $empShift) {
                    $empShift_id = $empShift->shift_id;
                    $shift_settings = Shiftsetting::where('shift_id', $empShift_id)
                        ->where('day', $day)->get();

                    foreach ($shift_settings as $shift_setting) {

                        if ($shift_setting->nextday == 'yes') {
                            $today_date = $report_date;
                            $today_date = new Carbon($today_date);
                            $today_date = $today_date->addDays(1);
                            $today_date = $today_date->toDateString();
                            $day = new DateTime($today_date);
                            $day = $day->format('l');


                        }


                        $attendance = Attendance::where('check_date', $today_date)->where('user_id', $user->id)->get();

                        if ($attendance !== null) {

                            foreach ($attendance as $attendance) {

                                $time = $attendance->check_time;


                                if (strtotime($time) >= strtotime($shift_setting->start_leave)
                                    && strtotime($time) <= strtotime($shift_setting->end_leave)) {

                                    if (strtotime($shift_setting->time_leave) - strtotime($time) <= 0 == true) {
                                        $time_note = date('H:i:s', strtotime($time));
                                        $delay = (new Carbon($time_note))->diff(new Carbon($shift_setting->time_leave))->format('%h:%I');


                                        $notes_out = ' / ' . " انصراف متاخر  " . $delay;

                                    } elseif (strtotime($shift_setting->time_leave) - strtotime($time) > 0 == true) {

                                        $time_note = date('H:i:s', strtotime($time));
                                        $delay = (new Carbon($shift_setting->time_leave))->diff(new Carbon($time_note))->format('%h:%I');

                                        $notes_out = ' / ' . " انصراف مبكر  " . $delay;


                                    }
                                    $shift_id = $shift_setting->shift_id;
                                    $shift = Shift::where('id', $shift_id)->first();
                                    $shift_name = $shift->name;


                                    $data_out['check_out_time'] = $time;

                                    if ($shift_setting->nextday == 'yes') {
                                        $today_date = $report_date;
                                    }


                                    $dd = TempAttendance::where('check_date', $today_date)->where('shift', $shift_name)->where('user_id', $user->id)->first();
                                    if ($dd === null) {
                                        $data_out['shift']= $shift_name;
                                        $data_out['check_date']= $today_date;
                                        $data_out['user_id']= $user->id;
                                        $data_out['notes'] = '   لم يتم تسجيل حضور ' . $notes_out;

                                        TempAttendance::create($data_out);

                                        $data_out = null;

                                    } else {
                                        $data_out['notes'] = $dd->notes . '' . $notes_out;
                                        TempAttendance::where('check_date', $today_date)->where('shift', $shift_name)->where('user_id', $user->id)->update($data_out);

                                    }


                                     }
                            }
                        }
                    }


                }
            }


            $temp_date = TempAttendance::all();


            $emp = User::all();

//        return response(['status' => true, 'msg' => $temp_date]);
            if ($request['reportdate'] == null) {

                $today_datee = Carbon::now();
                $today_datee = $today_datee->toDateString();

            } else {

                $today_datee = $request['reportdate'];
            }
            return view('cpanel.reports.dailyreport', compact('temp_date', 'emp','today_datee','employee'));

        }

        else {

            $employee =$request['user'];
            $employee=User::where('id',$request['user'])->first();
            $todaye_date = $report_date;
            $todaye_date = new Carbon($todaye_date);
            $todaye_date = $todaye_date->toDateString();
            $daye = new DateTime($todaye_date);
            $daye = $daye->format('l');


            $empShiftt = EmpsShifts::where('emp_id', $request['user'])->get();
            foreach ($empShiftt as $empShiftt) {
                $empShift_id = $empShiftt->shift_id;
                $shift_settingss = Shiftsetting::where('shift_id', $empShift_id)
                    ->where('day', $daye)->get();

                foreach ($shift_settingss as $shift_settingss) {


                    $attendances = Attendance::where('check_date', $todaye_date)->where('user_id', $request['user'])->get();

                    if ($attendances !== null) {
                        $check_in_flag = 0;
                        $check_out_flag = 0;
                        foreach ($attendances as $attendances) {

                            $times = $attendances->check_time;
                            if (strtotime($times) >= strtotime($shift_settingss->start_attendance)
                                && strtotime($times) <= strtotime($shift_settingss->end_attendance)) {
                                if (strtotime($shift_settingss->time_attendance) - strtotime($times) <= 0 == true) {


                                    $time_note = date('H:i:s', strtotime($times));
                                    $delays = (new Carbon($time_note))->diff(new Carbon($shift_settingss->time_attendance))->format('%h:%I');


                                    $notes = " حضور متاخر  " . $delays;


                                } elseif (strtotime($shift_settingss->time_attendance) - strtotime($times) > 0 == true) {
                                    $time_note = date('H:i:s', strtotime($times));
                                    $delays = (new Carbon($shift_settingss->time_attendance))->diff(new Carbon($time_note))->format('%h:%I');

                                    $notes = " حضور مبكر  " . $delays;

                                }
                                $shift_idd = $shift_settingss->shift_id;
                                $shifts = Shift::where('id', $shift_idd)->first();
                                $shift_names = $shifts->name;

                                $data['check_date'] = $attendances->check_date;
                                $data['check_in_time'] = $times;
                                $data['shift'] = $shift_names;
                                $data['user_id'] = $attendances->user_id;
                                $data['notes'] = $notes;


                                //create table to store data temporary
                                $previous_temp = TempAttendance::where('shift', $shift_names)->where('user_id', $request['user'])->first();

                                if ($previous_temp) {
                                    $check_in_flag = 1;
                                } else {
                                    $check_in_flag = 0;
                                }
                                if ($check_in_flag != 1) {


                                    TempAttendance::create($data);

                                }
                            }
                        }
                    }
                }
            }


//        $temp_date = TempAttendance::where('check_date', $todaye_date)->orderBy('shift', "desc")->get();
//
//        $emp = User::all();
//        return response(['status' => true, 'msg' => $temp_date]);


            //out


            $today_date = $report_date;
            $today_date = new Carbon($today_date);
            $today_date = $today_date->toDateString();
            $day = new DateTime($today_date);
            $day = $day->format('l');


            $empShift = EmpsShifts::where('emp_id', $request['user'])->get();
            foreach ($empShift as $empShift) {
                $empShift_id = $empShift->shift_id;
                $shift_settings = Shiftsetting::where('shift_id', $empShift_id)
                    ->where('day', $day)->get();

                foreach ($shift_settings as $shift_setting) {

                    if ($shift_setting->nextday == 'yes') {

                        $today_date = $report_date;
                        $today_date = new Carbon($today_date);
                        $today_date = $today_date->addDays(1);
                        $today_date = $today_date->toDateString();
                        $day = new DateTime($today_date);
                        $day = $day->format('l');


                    }


                    $attendance = Attendance::where('check_date', $today_date)->where('user_id', $request['user'])->get();

                    if ($attendance !== null) {

                        foreach ($attendance as $attendance) {

                            $time = $attendance->check_time;


                            if (strtotime($time) >= strtotime($shift_setting->start_leave)
                                && strtotime($time) <= strtotime($shift_setting->end_leave)) {

                                if (strtotime($shift_setting->time_leave) - strtotime($time) <= 0 == true) {
                                    $time_note = date('H:i:s', strtotime($time));
                                    $delay = (new Carbon($time_note))->diff(new Carbon($shift_setting->time_leave))->format('%h:%I');


                                    $notes_out = ' / ' . " انصراف متاخر  " . $delay;

                                } elseif (strtotime($shift_setting->time_leave) - strtotime($time) > 0 == true) {

                                    $time_note = date('H:i:s', strtotime($time));
                                    $delay = (new Carbon($shift_setting->time_leave))->diff(new Carbon($time_note))->format('%h:%I');

                                    $notes_out = ' / ' . " انصراف مبكر  " . $delay;


                                }
                                $shift_id = $shift_setting->shift_id;
                                $shift = Shift::where('id', $shift_id)->first();
                                $shift_name = $shift->name;


                                $data_out['check_out_time'] = $time;

                                if ($shift_setting->nextday == 'yes') {
                                    $today_date = $report_date;
                                }


                                $dd = TempAttendance::where('check_date', $today_date)->where('shift', $shift_name)->where('user_id', $request['user'])->first();
                                 if ($dd === null) {
                                     $data_out['check_date']= $today_date;
                                     $data_out['shift']= $shift_name;
                                     $data_out['user_id']= $request['user'];
                                     $data_out['notes'] = '' . $notes_out;
                                     $data_out['notes'] = '   لم يتم تسجيل حضور ' . $notes_out;

                                     TempAttendance::create($data_out);
                                     $data_out = null;


                                 } else {
                                    $data_out['notes'] = $dd->notes . '' . $notes_out;
                                     TempAttendance::where('check_date', $today_date)->where('shift', $shift_name)->where('user_id', $request['user'])->update($data_out);

                                 }





                                // $temp_date = TempAttendance::where('check_date', $today_date)->orderBy('shift', "desc")->get();


                            }
                        }
                    }
                }


            }
        }



        $temp_date = TempAttendance::all();


        $emp = User::all();
        if ($request['reportdate'] == null) {

            $today_datee = Carbon::now();
            $today_datee = $today_datee->toDateString();

        } else {

            $today_datee = $request['reportdate'];
        }

        return view('cpanel.reports.dailyreport', compact('temp_date', 'emp','today_datee','employee'));



    }

    public function export_pdf()
    {
        $date = TempAttendance::first();
        $setting = Setting::first();
        $data = TempAttendance::all();

        $pdf = PDF::loadView('cpanel.printReports.dailyreport', ['data' => $data , 'date'=>$date,'setting'=>$setting]);
        return $pdf->stream('dailyreport.pdf');

    }


}
