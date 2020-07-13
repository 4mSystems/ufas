
@extends('welcome')
@section('content')
<br> 
<div class="app-content content container-fluid">
                  <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('jobs')}}"> {{trans('admin.Jobs')}} </a>
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
              <h3 class="card-title">{{trans('admin.createtitle')}} </h3>
            </div>
            <!-- /.card-header -->
             <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
            <form method="post" id="users" action="{{url('jobs')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>{{trans('admin.jobname')}}</strong>
                                        <input type="text" name="name" class="form-control" id="name"  
                                               value="{{ old('name') }}">
                                     
                                 </div>

                                        <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                        <strong>{{trans('admin.managername')}}</strong>
                                       
                                        <select id="manager" name="manager"   class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" >

                                        @foreach($manager as $manager)
                                                        <option
                                                            value='{{$manager->id}}'>{{$manager->name}}
                                                            </option>
                                                    @endforeach

                                          </select>
                                     
                                    </div>

                                     <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                            <strong>{{trans('admin.deptName')}}</strong>
                                            <select id="dept_id" name="dept_id"  class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" >
                                            @foreach($departments as $departments)
                                                            <option
                                                                value='{{$departments->id}}'>{{$departments->name}}</option>
                                                        @endforeach

                                                                </select>
                                        </div>  

 




                                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                            <strong>{{trans('admin.enablemanager')}}</strong>
                                            <select id="enabled" name="enabled"  class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" >
                                            
                                                            <option value='yes'>{{trans('admin.yes')}}</option>
                                                            <option value='no'>{{trans('admin.no')}}</option>

                                                                </select>
                                        </div>  
                                
                                </div>
                              
                                <input type="submit" class="btn btn-info"  value="{{trans('admin.Add')}} "/>

                            </div>

                        </form>
    </div>
 


@endsection
