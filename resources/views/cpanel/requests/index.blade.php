
@extends('welcome')
@section('content')
    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item">  <a href="{{url('requestslist')}}">{{trans('admin.permissionList')}}
                    </a> </li>

            </ol>
        </div>
    </div>


    <!-- /.card-header -->


    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>

            <div class="content-body">




                <!-- stats -->
                <div class="row">

                    <div class="card">
                        <div class="card-body">
                            <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>

                                {!! Form::open(['url' => ['requestslist'] , 'method'=>'post']) !!}
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <strong>{{trans('admin.filter_from')}}</strong>
                                    {{ Form::date('filter_from',old('filter_from'),["class"=>"form-control" ]) }}
                                </div>
                                <div class="form-group">
                                    <strong>{{trans('admin.filter_to')}}</strong>
                                    {{ Form::date('filter_to',old('filter_to'),["class"=>"form-control" ]) }}
                                </div>


                                <div class="form-group">
                                    <strong>{{trans('admin.choosestatues')}}</strong>
                                    {!! Form::select('filter_status', ['all'=>(trans('admin.all')) ,'notyet'=>trans('admin.notyet') , 'accepted'=>trans('admin.accepted') ,  'declined'=>trans('admin.declined')] , old('filter_status'), ['class'=>'form-control',null]) !!}

                                </div>

                                {{ Form::submit( trans('admin.search') ,['class'=>'btn btn-info']) }}
                                {{ Form::close() }}




                            </div>







                            <div class="card-body collapse in">


                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <h3 class="card-title">{{trans('admin.permissionLists')}} </h3>
                                </div>



                                <div class="table-responsive" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <table class="table">
                                        <thead class="bg-info">
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('admin.empname')}}</th>
                                            <th>{{trans('admin.job')}}</th>
                                            <th>{{trans('admin.request_date')}}</th>
                                            <th>{{trans('admin.statues')}} </th>
                                            <th> </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach($askpermission as $askpermission)
                                            <tr>
                                                <th scope="row">{{$askpermission->id}}</th>
                                                <td>{{$askpermission->getUser->name}}</td>
                                                <td>{{$askpermission->getJob->name}}</td>
                                                <td>{{$askpermission->request_date}} </td>
                                                <td>{{trans('admin.'.$askpermission->status)}} </td>
                                                <td> <a class='btn btn-raised btn-success btn-sml' href=" {{url('askpermission/'.$askpermission->id.'/edit')}}" ><i class="icon-edit"></i></a>
                                              



                                                </td>
                                            </tr>
                                        @endforeach
                                       
                                        </tbody>
                                    </table>

                                </div>
                            </div>


                            <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                <h3 class="card-title">{{trans('admin.vacationList')}} </h3>
                            </div>



                            <div class="table-responsive" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                <table class="table">
                                    <thead class="bg-info">
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.empname')}}</th>
                                        <th>{{trans('admin.job')}}</th>
                                        <th>{{trans('admin.request_date')}}</th>
                                        <th>{{trans('admin.statues')}} </th>
                                        <th> </th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($vacationRequest as $vacationRequest)
                                        <tr>
                                            <th scope="row">{{$vacationRequest->id}}</th>
                                            <td>{{$vacationRequest->getUser->name}}</td>
                                            <td>{{$vacationRequest->getJob->name}}</td>
                                            <td>{{$vacationRequest->request_date}} </td>
                                            <td>{{trans('admin.'.$vacationRequest->status)}} </td>
                                            <td> <a class='btn btn-raised btn-success btn-sml' href=" {{url('vacationrequest/'.$vacationRequest->id.'/edit')}}" ><i class="icon-edit"></i></a>

                                                                                                   



                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>







@endsection
