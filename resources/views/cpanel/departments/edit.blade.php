
@extends('welcome')
@section('content')
 
<h1 class="m-0 text-dark"> {{trans('admin.editdept')}} </h1>

<div class="card-body">


<br> 
<div class="app-content content container-fluid">
                  <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"> <a href="{{url('departments')}}">{{trans('admin.departments')}} </a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.edit')}} 
                </li>
              </ol>
            </div> 
       </div>

                @if(session('msg'))
                <div class="alert alert-info" role='alert'>
                {{session('msg')}}
                </div>
                @endif
                
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
            <div class="card-header">
              <h3 class="card-title">{{trans('admin.editdept')}} </h3>
            </div>
            <!-- /.card-header -->
            <!-- <form method="put"  action="{{url('departments/'.$department->id)}}">
                            
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    
                                        <strong>{{trans('admin.deptName')}}</strong>
                                        <input type="text" name="name" class="form-control" id="name"  
                                               value="{{ $department->name}}">
                                     
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-info"   value="{{trans('admin.edit')}}"/>

                            </div>

                        </form> -->
<div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>

                        {!! Form::model($department, ['route' => ['departments.update',$department->id] , 'method'=>'put' ,'files'=> true]) !!}
         
         <input type="hidden" name="_token" value="{{csrf_token()}}">

         <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-12">
                     <strong>{{trans('admin.deptName')}}</strong>
                     <input type="text" name="name" class="form-control" id="name"  
                            value="{{$department->name}}">
                  
              </div>
 
             </div>
             <div   style=' padding-top: 10px;
                           
                             padding-left: 20px;
                             '>
             {!! Form::submit( trans('admin.edit') , array('class'=>'btn btn-info')) !!}
            

         </div>

  {!! Form::close() !!}
</div>
                

@endsection