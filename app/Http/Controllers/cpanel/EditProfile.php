<?php

namespace App\Http\Controllers\cpanel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class EditProfile extends Controller
{
    public function edit(){
        $user_id=auth()->user()->id;
        $employee = User::where('id',$user_id)->first();

        return view('cpanel.employee.editprofile' , compact('employee'));

    }

    public function update(Request $request){

        $id = auth()->user()->id;
        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:users,name,' . $id,
                'mobile' => 'numeric|required|unique:users,mobile,' . $id,
                'address' => 'nullable',
                'email' => 'nullable',

            ]);

        if($request->password != null){
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data);
        session()->flash('success', trans('admin.addedsuccess'));
        return redirect(url('home'));

    }
}
