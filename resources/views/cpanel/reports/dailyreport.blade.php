@extends('welcome')
@section('content')
    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('dailyreport')}}">{{trans('admin.dailyreport')}}
                    </a></li>

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

                                {!! Form::open(['url' => ['dailyreport'] , 'method'=>'post']) !!}
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <strong>{{trans('admin.reportdate')}}</strong>
                                    {{ Form::date('reportdate',old('reportdate'),["class"=>"form-control" ]) }}
                                </div>


                                <div class="form-group">
                                    <strong>{{trans('admin.employee')}}</strong>

                                    <select name="user" id="user" class='form-control'>
                                        <option value="all">{{trans('admin.allemployees')}}</option>


                                        @foreach($emp as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>

                                        @endforeach
                                    </select>
                                </div>

                                {{ Form::submit( trans('admin.search') ,['class'=>'btn btn-info']) }}
                                {{ Form::close() }}


                            </div>


                            <div class="card-body collapse in">


                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <h3 class="card-title">{{trans('admin.dailyreport')}} </h3>
                                    <a href="{{url('printdailyreport')}}" target="_blank" class="btn btn-info">
                                        <i class="icon-printer4"></i>{{trans('admin.print')}} </a>
                                </div>

                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             text-align: center;
                             '>
                                    <h3>التقرير اليومى </h3>
                                </div>
                                <div style="text-align: center;">
                                    <h4>يوم {{$today_datee}}
                                        @if($employee == "all")
                                            ({{trans('admin.all')}})
                                        @else
                                 ({{$employee->name}})
                                        @endif
                                    </h4>
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
                                            <th>{{trans('admin.shiftt')}} </th>
                                            <th>{{trans('admin.checkintime')}}</th>
                                            <th>{{trans('admin.checkouttime')}} </th>
                                            <th>{{trans('admin.notes')}} </th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $id = 1;
                                        @endphp
                                        @php

                                        @endphp
                                         @foreach($temp_date as $temp_date)
                                            <tr>

                                                <th scope="row">{{$id}}</th>
                                                <td>{{$temp_date->getUser->name}}</td>
                                                <td>{{$temp_date['shift']}}</td>

                                                @if($temp_date['check_in_time']!=null)
                                                    <td>{{date('H:i', strtotime($temp_date['check_in_time']))}} </td>
                                                @else
                                                    <td style="color: red"> لم يتم تسجيل حضور</td>
                                                @endif
                                                @if($temp_date['check_out_time']!=null)
                                                    <td>{{date('H:i', strtotime($temp_date['check_out_time']))}} </td>
                                                @else
                                                    <td style="color: red"> لم يتم تسجيل انصراف</td>
                                                @endif

                                                @if($temp_date['check_out_time']!=null)

                                                    <td>{{$temp_date['notes']}} </td>
                                                @else
                                                    <td>{{$temp_date['notes']}} /لم يسجل انصراف</td>
                                                @endif

                                            </tr>
                                            @php
                                                $id++;
                                            @endphp

                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>


                        </div>




@endsection
