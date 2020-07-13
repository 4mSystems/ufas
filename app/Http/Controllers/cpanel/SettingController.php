<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Up;
use Storage;
use DB;
use File;
class SettingController extends Controller
{
    public function setting()
    {
        $setting =  Setting::orderBy('id','desc')->first();

        return view('cpanel.setting',compact('setting'));
    }


    public function setting_save()
    {

        $data = $this->validate(request(),[
            'logo'=>'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp',
            'system_name_ar'=>'required',
            'system_name_en'=>'required',
            'contacts'=>'required',

        ],[],[
            'logo'=>'Logo',

        ]);


        if(request()->hasFile('logo')){

             $old = Setting::orderBy('id','desc')->first();
           File::delete('storage/app/public/settings/'.$old['logo']);
           

            $data['logo']= Up::upload([

                'file'=>'logo',
                'path'=>'settings',
                'upload_type'=>'single',
                'delete_file'=>'',

            ]);
        }

//
        Setting::orderBy('id','desc')->update($data);
         return redirect(url('settings'));



    }
}
