
@extends('welcome') 
@push('js')

<script type="text/javascript">
  
$(document).ready(function(){ 

  @if($employee->dept_id) 
  $.ajax({
    url:"{{url('employee/'.$employee->id.'/edit')}}",
    type:'get',
    datatype:'html',
    data:{dept_id:"{{$employee->dept_id}}",select:"{{$employee->job_id}}"},
    success:function(data){ 
      $('.job').html(data);
       
    }
  });
  @endif

$(document).on('change','.dept_id',function(){
var department=$('.dept_id option:selected').val();
if(department >0){
  $.ajax({ 

    url:"{{url('employee/'.$employee->id.'/edit')}}",
    type:'get',
    datatype:'html',
    data:{dept_id:department,select:""},
    
    success:function(data){
    
      $('.job').html(data);
    }
  }); 

}else {  $('.job').html('');}
});
});


</script>


@endpush 
@section('content') 
<br> 

<div class="app-content content container-fluid">
                  <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('employee')}}">{{trans('admin.employee')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.edit')}} 
                </li>
              </ol>
            </div> 
       </div>

<div class="card-body">
               
                
        <div class="app-content content container-fluid">
                         <div class="content-wrapper">
                        <div class="content-header row">
                        </div>
                  <div class="content-body"><!-- stats -->
                            <div class="row">
    
                                      <div class="card">
                                                  <div class="card-body">
                                            <div class="card-body collapse in">
              
          <div class="card" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
            <div class="card-header">
              <h3 class="card-title">{{trans('admin.edit')}} </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
            
            {!! Form::model($employee, ['route' => ['employee.update',$employee->id] , 'method'=>'put' ,'files'=> true]) !!}
            {{ csrf_field() }}
              

            <div class="form-group"> 
            <strong>{{trans('admin.empName')}}</strong>
            {{ Form::text('name',$employee->name,["class"=>"form-control" ]) }}
            </div> 

            <div class="form-group"> 
            <strong>{{trans('admin.mobile')}}</strong> 
             {{ Form::number('mobile',$employee->mobile,["class"=>"form-control" ,'max'=>'9999999999999'   ]) }}  
            </div> 
            
            <div class="form-group"> 
            <strong>{{trans('admin.address')}}</strong> 
             {{ Form::text('address',$employee->address,["class"=>"form-control"  ]) }}  
            </div> 
            
            <div class="form-group"> 
            <strong>{{trans('admin.salary')}}</strong> 
             {{ Form::number('salary',$employee->salary,["class"=>"form-control" ,'max'=>'999999' ]) }}  
            </div> 
            






            <div class="form-group"> 
            <strong>{{trans('admin.department')}}</strong> 
            {{ Form::select('dept_id',App\Department::pluck('name','id'),
                $employee->dept_id
            ,["class"=>"form-control dept_id " , 'placeholder'=>'Choose department']) }}
            </div> 




            <div class="form-group"> 
            <strong>{{trans('admin.job')}}</strong>  
            <span class='job'></sapn>
            </div> 


            <div class="form-group"> 
            <strong>{{trans('admin.bounuse')}}</strong> 
            {{ Form::select('bonuses_id',App\Bonuses::pluck('name','id'),$employee->bonuses_id
            ,["class"=>"form-control "]) }}
            </div> 


            <div class="form-group"> 
            <strong>{{trans('admin.email')}}</strong> 
             {{ Form::email('email',$employee->email,["class"=>"form-control"  ]) }}  
            </div> 


            <div class="form-group"> 
            <strong>{{trans('admin.work_hour')}}</strong> 
             {{ Form::number('work_hour',$employee->work_hour,["class"=>"form-control" ,'max'=>'20' ]) }}  
            </div> 

            
            

            {{ Form::submit( trans('admin.edit') ,['class'=>'btn btn-info']) }}
            {{ Form::close() }} 
            </div> 

            


@endsection
