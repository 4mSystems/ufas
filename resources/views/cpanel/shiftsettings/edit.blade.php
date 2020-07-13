@extends('welcome')
@section('content')

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>

    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a
                        href="{{url('shiftsettings/'.$shiftsetting->shift_id)}}"> {{trans('admin.shiftsettings')}} </a>
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

                                    <div class="card">
                                        <div class="card-header" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                            <h3 class="card-title">{{trans('admin.edit')}} </h3>
                                            <h3>{{$shiftName->name}}</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                            <div class="card-title">{{$shiftsetting->day}}</div>

                                            {!! Form::model($shiftsetting, ['url' => ['shiftsetting/update/'.$shiftsetting->id] , 'method'=>'post' ]) !!}
                                            {!! csrf_field() !!}


                                            <div class="card-title">{{trans('admin.attendances')}}</div>


                                            <div class="form-group">
                                                <strong>{{trans('admin.attendancetime')}}</strong>
                                                {{ Form::time('time_attendance',$shiftsetting->time_attendance,["class"=>"form-control" ]) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>{{trans('admin.start_attendance')}}</strong>
                                                {{ Form::time('start_attendance',$shiftsetting->start_attendance,["class"=>"form-control" ]) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>{{trans('admin.end_attendance')}}</strong>
                                                {{ Form::time('end_attendance',$shiftsetting->end_attendance,["class"=>"form-control" ]) }}
                                            </div>


                                            <div class="card-title">{{trans('admin.leaves')}}</div>
                                            <div class="form-group">
                                                <strong
                                                    style="padding-left: 25px">{{trans('admin.leavenextday')}}</strong>
                                                <input type="hidden" name="nextday" id='nextday' value="no">
                                                {{ Form::checkbox('nextday','yes',  $shiftsetting->nextday=="yes"?true:false) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>{{trans('admin.time_leave')}}</strong>
                                                {{ Form::time('time_leave',$shiftsetting->time_leave,["class"=>"form-control" ]) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>{{trans('admin.start_leave')}}</strong>
                                                {{ Form::time('start_leave',$shiftsetting->start_leave,["class"=>"form-control" ]) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>{{trans('admin.end_leave')}}</strong>
                                                {{ Form::time('end_leave',$shiftsetting->end_leave,["class"=>"form-control" ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.vacation')}}</strong>
                                                {!! Form::select('vacation', ['yes'=>trans('admin.yes') , 'no'=>trans('admin.no')] , $shiftsetting->vacation, ['class'=>'form-control',null]) !!}

                                            </div>
                                            <div class="form-group">
                                                <strong
                                                    style="padding-left: 50px">{{trans('admin.addAll')}}</strong>
                                                <label class="switch">
                                                    <input type="hidden" name="addAll" id='addAll' value="no">
                                                    {{ Form::checkbox('addAll', 'yes') }}

                                                    <span class="slider round"></span>
                                                </label>
                                            </div>


                                            {{ Form::submit( trans('admin.edit') ,['class'=>'btn btn-info']) }}
                                            {{ Form::close() }}


                                        </div>



@endsection
