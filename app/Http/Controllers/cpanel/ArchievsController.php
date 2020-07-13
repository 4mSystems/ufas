<?php

namespace App\Http\Controllers\cpanel;

use App\Attendance;
use App\Permission;
use App\User;
use App\Excelsheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use DateTime;

  
class ArchievsController extends Controller
{

    public function index()
    {
        $too_date = Carbon::now();
        $to_date = $too_date->toDateString();
        $month = $too_date->month;
        if ($month < 10) {
            $month = "0" . $month;
        }
        $year = $too_date->year;
        $from_date = $year . "-" . $month . "-01";

        $attendances = Attendance::whereBetween('check_date', [$from_date, $too_date->toDateString()])->get();
         
        $emp = User::all();
        $users = "all";
        $user_id=auth()->user()->id;
        $permission =Permission::where('user_id',$user_id)->first();
//        dd($attendance);
        return view('cpanel.reports.archievs', compact('attendances', 'emp','permission','from_date','to_date','users'));


    }

    public function store(Request $request)
    {
        $from_date = $request['filter_from'];
        $to_date = $request['filter_to'];
        $user = $request['user'];
        $users = $request['user'];
        $emp = User::all();
        if ($user == "all") {
            $attendances = Attendance::whereBetween('check_date', [$from_date, $to_date])->get();
        } else {
            $attendances = Attendance::whereBetween('check_date', [$from_date, $to_date])->where('user_id', $user)->get();
            $users = User::where('id',$users)->first();
        }
        $user_id=auth()->user()->id;
        $permission =Permission::where('user_id',$user_id)->first();
        return view('cpanel.reports.archievs', compact('attendances', 'emp','permission','from_date','to_date','users'));

    }


    public function insert(Request $request)
    {


        $emp = User::all();

        $data = $this->validate(\request(),
            [
                'user_id' => 'required',
                'check_date' => 'required',
                'check_time' => 'required',
            ]);


        Attendance::create($data);


        $to_date = Carbon::now();
        $month = $to_date->month;
        if ($month < 10) {
            $month = "0" . $month;
        }
        $year = $to_date->year;
        $from_date = $year . "-" . $month . "-01";

        $attendances = Attendance::whereBetween('check_date', [$from_date, $to_date->toDateString()])->get();

//        dd($attendance);
        return redirect(url('archievs'));
    }
    public function edit_attend($id)
    {
        if (request()->ajax()) {
            $data = Attendance::findOrFail($id);
            return response()->json(['data' => $data]);
        }

    }

    public function update(Request $request)
    {
        $data=$this->validate(\request(),
            [
                'id'=>'required',
                'user_id' => 'required',
                'check_date' => 'required',
                'check_time' => 'required',

            ]);

        Attendance::where('id',$request['id'])->update($data);
        session()->flash('msg',trans('admin.updatedsuccess'));
        return redirect(url('archievs'));

    }




    public function destroy($id)
    {

        $attend = Attendance::find($id);
        $attend->delete();


        return redirect(url('archievs'));


    }

     
    public function importExcel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv',
        ]);
        $user_id = $request->employee_id;
       
 
        $input = $request->all();
            
        if($request['file'] != null)
        {
	        // This is file Information ... 
            $file	 = $request->file('file');
            $name    = $file->getClientOriginalName();
			$ext 	 = $file->getClientOriginalExtension();
			$size 	 = $file->getSize();
            $path 	 = $file->getRealPath(); 
			$mime 	 = $file->getMimeType();
			
			// Move Image To Folder ..
            $fileNewName = "file".time().'.'.$ext;
            // $save_path =public_path("uploads/"); for server not localhost
            $save_path =public_path("uploads\\");
            $file->move($save_path, $fileNewName);
            $realPath = $save_path.$fileNewName;  
           
           
          $data =  Excel::toArray(new Excelsheet ,$realPath);
          
            if(!empty($data)){ 
                
           foreach($data as $row){
               foreach($row as $s){
              
               $value = $s[0];
              
             
        $dateee = new Carbon($value);
         $time   =  date('H:i:s', strtotime($dateee));
         $datee = date('Y-m-d', strtotime($dateee));
        
           
            $arr['user_id'] = $user_id;
            $arr ['check_date'] = $datee;
            $arr['check_time'] = $time;
             
            Attendance::create($arr);
              
        }
              
                }

                //   dd($arr);
           
                // Attendance::create($arr);
        
           return redirect(url('archievs'));
        }
	         
        return redirect(url('archievs'));
        }
        return redirect(url('archievs'));
    }
     
}
