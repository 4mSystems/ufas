@extends('welcome')
@section('content')
    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('mothlyreport')}}">{{trans('admin.mothlyreport')}}
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

                                {!! Form::open(['url' => ['mothlyreport'] , 'method'=>'post']) !!}
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
                                    <strong>{{trans('admin.employee')}}</strong>

                                    <select name="user" id="user" class='form-control'>
                                        @foreach($emps as $user)
                                            <option value="{{$user->id}}">"{{$user->name}}"</option>

                                        @endforeach
                                    </select>
                                </div>

                                {{ Form::submit( trans('admin.search') ,['class'=>'btn btn-success']) }}
                                {{ Form::close() }}


                            </div>


                            <div class="card-body collapse in">


                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <h3 class="card-title">{{trans('admin.mothlyreport')}} </h3>
                                    <a href="{{url('printmonthlyreport')}}" target="_blank" class="btn btn-info">
                                        <i class="icon-printer4"></i>{{trans('admin.print')}} </a>
                                </div>


                                <div class="table-responsive" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <table class="table">
                                        <thead class="bg-info">
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('admin.datee')}} </th>
                                            <th>{{trans('admin.shiftt')}} </th>
                                            <th>{{trans('admin.day')}} </th>

                                            <th>{{trans('admin.attendance_delay')}}</th>
                                            <th>{{trans('admin.leave_early')}}</th>

                                            <th>{{trans('admin.attendance_early')}}</th>
                                            <th>{{trans('admin.leave_delay')}}</th>

                                            <th>{{trans('admin.no_attendance')}}</th>
                                            <th>{{trans('admin.no_leave')}}</th>
                                            <th>{{trans('admin.absences')}}</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $id = 1;
                                        @endphp

                                        @foreach($temp as $temp)
                                            <tr>
                                                <th scope="row">{{$id}}</th>
                                                <td>{{$temp->check_date}}</td>
                                                <td>{{$temp->shift}} </td>
                                                <td>{{$temp->day}} </td>
                                                @if($temp->attendance_delay == null)
                                                    <td></td>
                                                @else
                                                    <td>{{ date('H:i', strtotime($temp->attendance_delay))}} </td>

                                                @endif
                                                @if($temp->leave_early == null)
                                                    <td></td>
                                                @else
                                                    <td>{{ date('H:i', strtotime($temp->leave_early))}} </td>

                                                @endif
                                                @if($temp->attendance_early == null)
                                                    <td></td>
                                                @else
                                                    <td>{{ date('H:i', strtotime($temp->attendance_early))}} </td>

                                                @endif
                                                @if($temp->leave_delay == null)
                                                    <td></td>
                                                @else
                                                    <td>{{ date('H:i', strtotime($temp->leave_delay))}} </td>

                                                @endif

                                                @if($temp->no_attendance == 'no')
                                                    <td></td>
                                                @else
{{--                                                    <td>{{$temp->no_attendance}}</td>--}}
                                                    <td><i class="icon-square-check"></i></td>
                                                @endif
                                                @if($temp->no_leave == 'no')
                                                    <td></td>
                                                @else
{{--                                                    <td>{{$temp->no_leave}}</td>--}}

                                                    <td><i class="icon-square-check"></i></td>
                                                @endif
                                                @if($temp->absences == 'no')
                                                    <td></td>
                                                @else
{{--                                                    <td>{{$temp->absences}}</td>--}}
                                                    <td><i class="icon-square-check"></i></td>
                                                @endif





                                            </tr>
                                            @php
                                                $id++;
                                            @endphp

                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>

                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <h3 class="card-title">{{trans('admin.summary')}} </h3>
                                </div>


                                <div class="table-responsive" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <table class="table ">
                                        <thead class="bg-warning">
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('admin.statement')}} </th>
                                            <th>{{trans('admin.withPermission')}} </th>
                                            <th>{{trans('admin.withoutPermission')}} </th>
                                            <th>{{trans('admin.total')}}</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $id = 1;
                                        @endphp

                                        @foreach($temp_summary as $temp_summary)
                                            <tr>
                                                <th scope="row">{{$id}}</th>
                                                <td>{{trans('admin.'.$temp_summary->name)}}</td>
                                                <td>{{$temp_summary->with}} </td>
                                                <td>{{$temp_summary->without}} </td>
                                                <td>{{$temp_summary->total}} </td>
                                            </tr>
                                            @php
                                                $id++;
                                            @endphp

                                        @endforeach

                                        </tbody>
                                    </table>






@endsection
