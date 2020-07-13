<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;


class uploadController extends Controller
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
   public function upload(Request $request){
       $rules = [

           'image' => 'required',

       ];
       $validator = Validator::make($request->all(), $rules);
       if ($validator->fails()) {

           return $this->sendResponse(false, $this->validationErrorsToString($validator->messages()));
       }else{

       $file	 = $request->file('image');
       $name    = $file->getClientOriginalName();
       $ext 	 = $file->getClientOriginalExtension();
       $size 	 = $file->getSize();
       $path 	 = $file->getRealPath();
       $mime 	 = $file->getMimeType();

       // Move Image To Folder ..
       $fileNewName = 'uploads/images/img_'.time().'.'.$ext;
       $file->move(public_path('uploads/images'), $fileNewName);

            $msg = ' photo uploaded successfully ! ';

           return $this->sendResponse(true, $msg,$fileNewName);

       }
   }
}
