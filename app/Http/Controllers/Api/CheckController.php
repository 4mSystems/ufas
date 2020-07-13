<?php

namespace App\Http\Controllers\Api;

use App\empworkplaces;
use App\Workplace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Attendance;
use Validator;
use Auth;

class CheckController extends Controller
{
    public $objectName;


    public function __construct(Attendance $model)
    {
        $this->objectName = $model;

    }

    public function sendResponse($status, $msg = null, $data = null)
    {
        if ($status == false) {
            return response(
                [
                    'status' => false,

                    'errors' => $data
                ]
            );
        } else {
            return response(
                [
                    'status' => true,
                    'msg' => $msg,
                    'data' => $data
                ]
            );
        }
    }

    public function validationErrorsToString($errArray)
    {
        $valArr = array();
        foreach ($errArray->toArray() as $key => $value) {
            $errStr = $value[0];
            array_push($valArr, $errStr);
        }
        return $valArr;
    }


    public function check(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'network_name' => 'required',
            'mac_address' => 'required',
            'image'=>'',

        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {

            return $this->sendResponse(false, $this->validationErrorsToString($validator->messages()));
        } else {
            $api_token = $request->input('api_token');
            $user = User::where('api_token', $api_token)->first();

            if($user ===null){
                $msg = 'لم نجد بيانات الادخال ف سجلاتنا ';
                return $this->sendResponse(false,$msg ,'برجاء التاكد من البيانات');

            }

            $empworkplaces = empworkplaces::where('emp_id',$user->id)->get();
//            dd($empworkplaces->count());
            if($empworkplaces->count() ==0){
                $msg = 'لم يتم تعيينك ف مكان عمل ';
                return $this->sendResponse(false,$msg ,'لا يمكنك تسجيل حضور قبل تعيين مكان عمل لك');
            }
        
          foreach ($empworkplaces as $empworkplaces) {


              $workplace = Workplace::where('id', $empworkplaces->workplace_id)->first();
          }
            if($workplace->network_name == $request->input('network_name') &&$workplace->mac_address ==$request->input('mac_address')  )
            {

                $data []=null;
                $mytime = Carbon::now()->format('H:i');
//                $time =  $mytime->toTimeString();
                $time = $mytime;
                $date = Carbon::now()->format('y-m-d');
//                $date = $mytime->toDateString();

                $data['user_id']=$user->id;
                $data['image']=$request->input('image');

                $data['check_date'] = $date;
                $data['check_time']= $time;




                $attendance = Attendance::create($data);
                    $msg = 'تم التسجيل بنجاح ';
                    // اخر تسجيل النهارده ؟؟؟
                $last_attend =  Attendance::where('user_id',$user->id)->where('check_date',$date)->first();
                $last_attend =$last_attend->check_time;
                return $this->sendResponse(true, $msg, $last_attend);



            }

            else  {
                $msg = null;
                return $this->sendResponse(false,$msg ,'بيانات شبكه الانترنت غير صحيحه');
            }
        }


    }


}
