
@extends('welcome')
@section('content')
    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('requestslist')}}">{{trans('admin.permissionList')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.VacationRequest')}}
                </li>
            </ol>
        </div>
    </div>
    <?php

    $current_id = $vacationRequest->id;

    $allnotify = auth()->user()->unreadNotifications;

    foreach($allnotify as $notify)
    {
        if($notify->type == 'App\Notifications\VacationsNotifications')
        {
            $id=$notify->data['id'];

            if($id == $current_id)
            {
                $notify->markAsRead();
            }
        }
    }

    ?>

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
                                            <h3 class="card-title">{{trans('admin.VacationRequest')}} </h3>
                                            <h5  class="card-title">{{trans('admin.Employee'). $vacationRequest->getUser->name }} </h5>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>

                                            {!! Form::model($vacationRequest, ['route' => ['vacationrequest.update',$vacationRequest->id] , 'method'=>'put' ]) !!}
                                            {!! csrf_field() !!}


                                            <div class="form-group">
                                                <strong>{{trans('admin.from_date')}}</strong>
                                                {{ Form::label('from_date',$vacationRequest->from_date,["class"=>"form-control" ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.to_date')}}</strong>
                                                {{ Form::label('to_date',$vacationRequest->to_date,["class"=>"form-control" ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.reason')}}</strong>
                                                {{ Form::label('reason',$vacationRequest->reason,["class"=>"form-control" ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.description')}}</strong>
                                                {{ Form::label('description',$vacationRequest->description,["class"=>"form-control" ]) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>{{trans('admin.ask_Date')}}</strong>
                                                {{ Form::label('request_date',$vacationRequest->request_date,["class"=>"form-control" ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.choosestatues')}}</strong>
                                                {!! Form::select('status', ['notyet'=>trans('admin.notyet') , 'accepted'=>trans('admin.accepted') ,  'declined'=>trans('admin.declined')] , $vacationRequest->status, ['class'=>'form-control',null]) !!}

                                            </div>

                                            {{ Form::submit( trans('admin.edit') ,['class'=>'btn btn-info']) }}
                                            {{ Form::close() }}




                                        </div>



@endsection
