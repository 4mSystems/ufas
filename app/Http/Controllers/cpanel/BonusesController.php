<?php

namespace App\Http\Controllers\cpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bonuses;
use Auth;
use App\Permission;
class BonusesController extends Controller
{


    public function __construct(){
    	$this->middleware('auth');
    }

    
    public function index()
    {
        $user_id=auth()->user()->id;
        $permission = Permission::where('user_id',$user_id)->first();
            $enabled =  $permission->overtimePage;
            if($enabled == 'yes'){
        
            $bounses=Bonuses::all();
            return view('cpanel.bonuses.index' , \compact('bounses'));
            }else{

                return redirect(url('home'));
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id=auth()->user()->id;
        $permission = Permission::where('user_id',$user_id)->first();
            $enabled =  $permission->overtimePage;
            if($enabled == 'yes'){
        return view('cpanel.bonuses.create');
    }else{

        return redirect(url('home'));
    }   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$this->validate(\request(),
        [
            'name'=>'required|unique:bonuses',
            'overtime'=>'required',
            'late'=>'required',
            'early'=>'required',
            'notsign'=>'required ',
            'absence'=>'required',

            

        ],[],[ 
            'name'=>'Name'
        ]);
 
       
            
             
        Bonuses::create($data);
        session()->flash('success',trans('admin.addedsuccess'));
        return redirect(url('bonuses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id=auth()->user()->id;
        $permission = Permission::where('user_id',$user_id)->first();
            $enabled =  $permission->overtimePage;
            if($enabled == 'yes'){
        $bonuse=Bonuses::findOrFail($id);
        return view('cpanel.bonuses.edit',\compact('bonuse'));
        }else{

            return redirect(url('home'));
        }      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data=$this->validate(\request(),
        [
            'name'=>'required|unique:bonuses,name,'.$id,
            'overtime'=>'required',
            'late'=>'required',
            'early'=>'required',
            'notsign'=>'required',
            'absence'=>'required', 

        ],[],[ 
            'name'=>'Name'
        ]);
 
            
        Bonuses::where('id',$id)->update($data);
     
        session()->flash('success',trans('admin.updatedsuccess'));
        return redirect(url('bonuses'));
         

    }

    // public function convertTimeTofloat($input){
    //         // $num_hours=str_replace(":",".",$input,$num_hours) ;
    //         // $hours = floor($num_hours);
    //         // $mins = round(($num_hours - $hours) * 60);
    //         //  $hour_one = $hours.'.'.$mins; 
    //         //  return $hour_one;

    //         $parts = explode(':', $input);
    //         return $parts[0] + floor(($parts[1]/60)*100) / 100 ;
 
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $bounses =  Bonuses::find($id);
        $bounses->delete();

           session()->flash('success',trans('admin.departmentdeleted'));
           return redirect(url('bonuses'));  
    }
}
