
@extends('welcome')
@section('content')
  

<div class="card-body">
<br> 
<div class="app-content content container-fluid">
                  <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"> <a href="{{url('departments')}}">{{trans('admin.departments')}} </a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.Add')}} 
                </li>
              </ol>
            </div> 
       </div>
                
        <div class="app-content content container-fluid">
                         <div class="content-wrapper">
                        <div class="content-header row">
                        </div>
                  <div class="content-body"><!-- stats -->
                            <div class="row">
    
                                      <div class="card">
                                                  <div class="card-body">
                                            <div class="card-body collapse in">
              
          <div class="card" >
            <div class="card-header" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
              <h3 class="card-title">{{trans('admin.createtitle')}} </h3>
            </div>
            <!-- /.card-header -->
             <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
            <form method="post" id="users" action="{{url('departments')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group{{$errors->has('name')?' has-error':''}}">
                                        <strong>{{trans('admin.deptName')}}</strong>
                                        <input type="text" name="name" class="form-control" id="name"  
                                               value="{{ old('name') }}">
                                     
                                    </div>
                                </div>
                                
                                 <div  style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                <input type="submit" class="btn btn-info" id="add_user" name="add_user" value="{{trans('admin.Add')}} "/>

                            </div>

                        </form>
    </div>

@endsection