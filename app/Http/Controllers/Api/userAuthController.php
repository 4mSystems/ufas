<?php

namespace App\Http\Controllers\Api;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Auth;

class userAuthController extends Controller
{
    public $objectName;


    public function __construct(User $model){
        $this->objectName = $model;

    }


    public function sendResponse($status, $msg=null ,$data = null)
    {
        if ($status == false)
        {
            return response(
                [
                    'status' => false,

                    'errors' => $data
                ]
            );
        }
        else
        {
            return response(
                [
                    'status' => true,
                    'msg'=>$msg,
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

    public function login(Request $request)
    {
        $rules = [
            'mobile'=>'required',
            'password'=>'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return $this->sendResponse(false, $this->validationErrorsToString($validator->messages()));
        }
        else
        {

            if(Auth::attempt([
                'mobile'=>$request->input('mobile'),
                'password'=>$request->input('password')
            ]))
            {


                $user = auth()->user();

                $user->api_token = str_random(60);
                $api_token = $user->api_token;
                $user->save();
           

                    $msg = 'تم تسجيل الدخول بنجاح .. ';
                return $this->sendResponse(true, $msg,$user);
            }
            else
            {
                $msg = 'عفوا لم يتم تسجيل الدخول  ';
                return $this->sendResponse(false, $msg,'رقم الموبايل او الرقم السري غير صحيح .. !');
            }
        }
    }

 public function settings(){


   $settings = Setting::first(['logo','system_name_ar','system_name_en','contacts']);

                if($settings->logo==null){

                }else{

                    $settings->logo = 'https://ufaspro.com/ufas/storage/app/public/'.$settings->logo;
                }


            $msg = '';
            return $this->sendResponse(true, $msg,$settings);
       

 }

    public function logout(Request $request){
        $api_token =$request->input('api_token');
        $user = User::where('api_token',$api_token)->first();

        if(empty($user)){
            return $this->sendResponse(false, 'Error user not found!!');
        }


        $user->api_token = null;
            if($user->save()){
                return $this->sendResponse(true, 'تم تسجيل الخروج بنجاح');
            }else{
                return $this->sendResponse(false, 'Error user not found !!');
            }
    }

}
