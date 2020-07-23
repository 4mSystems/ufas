
@extends('welcome') 

@section('content') 
@push('js')
     
  <script type="text/javascript">
  
  $(document).ready(function(){
    @if(old('dept_id'))
    $.ajax({
      url:"{{url('employee/create')}}",
      type:'get',
      datatype:'html',
      data:{dept_id:"{{old('dept_id')}}",select:"{{old('job_id')}}"},
      success:function(data){
        $('.job').html(data);
      }
    });
    @endif
$(document).on('change','.dept_id',function(){
  var department=$('.dept_id option:selected').val();
  if(department >0){
    $.ajax({
      url:"{{url('employee/create')}}",
      type:'get',
      datatype:'html',
      data:{dept_id:department,select:''},
      success:function(data){
        $('.job').html(data);
      }
    });

  }else {  $('.job').html('');}
});
  });
  
  
  </script>

 
@endpush 
<br> 
<div class="app-content content container-fluid">
                  <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('employee')}}">{{trans('admin.employee')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.Add')}} 
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
           <div class="card">
            <div class="card-header" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
              <h3 class="card-title">{{trans('admin.Add')}} </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
            
            {{ Form::open( ['url' => ['employee'],'method'=>'post'] ) }}
            {{ csrf_field() }}
              

            <div class="form-group"> 
            <strong>{{trans('admin.empName')}}</strong>
            {{ Form::text('name',old('name'),["class"=>"form-control" ]) }}
            </div> 

            <div class="form-group"> 
            <strong>{{trans('admin.mobile')}}</strong> 
             {{ Form::number('mobile',old('mobile'),["class"=>"form-control" ,'max'=>'9999999999999'   ]) }}  
            </div> 
            
            <div class="form-group"> 
            <strong>{{trans('admin.address')}}</strong> 
             {{ Form::text('address',old('address'),["class"=>"form-control"  ]) }}  
            </div> 
            
            <div class="form-group"> 
            <strong>{{trans('admin.salary')}}</strong> 
             {{ Form::number('salary',old('salary'),["class"=>"form-control" ,'max'=>'999999'  ]) }}  
            </div> 
             
            <div class="form-group"> 
            <strong>{{trans('admin.department')}}</strong> 
            {{ Form::select('dept_id',App\Department::pluck('name','id'),old('dept_id')
            ,["class"=>"form-control dept_id" ,'placeholder'=>trans('admin.chooseDept') ]) }}
            </div>                  
            <!-- /////  class of select is dept_id\\\\\\ -->




            <div class="form-group"> 
            <strong>{{trans('admin.job')}}</strong> 
             
          <span class='job'></sapn>
            </div> 


            <div class="form-group"> 
            <strong>{{trans('admin.bounuse')}}</strong> 
            {{ Form::select('bonuses_id',App\Bonuses::pluck('name','id'),old('bonuses_id')
            ,["class"=>"form-control "]) }}
            </div> 


            <div class="form-group"> 
            <strong>{{trans('admin.email')}}</strong> 
             {{ Form::email('email',old('email'),["class"=>"form-control"  ]) }}  
            </div> 


            <div class="form-group"> 
            <strong>{{trans('admin.work_hour')}}</strong> 
             {{ Form::number('work_hour',old('work_hour'),["class"=>"form-control" ,'max'=>'20'  ]) }}  
            </div> 

            <div class="form-group"> 
            <strong>{{trans('admin.password')}}</strong><br> 
             {{ Form::password('password',old('password'),["class"=>"form-control"  ]) }}  
            </div> 
            

            {{ Form::submit( trans('admin.Add') ,['class'=>'btn btn-info']) }}
            {{ Form::close() }} 
            </div> 

@endsection
 