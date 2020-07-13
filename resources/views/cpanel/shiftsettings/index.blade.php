
@extends('welcome')
@section('content')


    <br>
    <!-- /.card-header -->
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('shifts')}}">{{trans('admin.shifts')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.shiftsettings')}}
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

                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>

                                    <h3 class="card-title">{{trans('admin.shiftsettings')}} </h3>
                                    <h3>{{$shiftName->name}}</h3>
                                </div>

                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>

{{--                                    <h3 class="card-title"> {{$shiftSettings->shiftSettings->name}}</h3>--}}
{{--                                </div>--}}



                                <div class="table-responsive" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <table class="table">
                                        <thead class="bg-info">
                                        <tr>

                                            <th>{{trans('admin.days')}}</th>
                                            <th>{{trans('admin.attendancetime')}}</th>
                                            <th>{{trans('admin.leavetime')}}</th>
                                            <th>{{trans('admin.vacation')}} </th>
                                            <th> </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($shiftSettings as $shiftSettings)
                                            <tr>
                                                <td>{{$shiftSettings->day}}</td>


                                                <td>{{$shiftSettings->time_attendance}}</td>


                                                <td>{{$shiftSettings->time_leave}} </td>
                                                <td>{{$shiftSettings->vacation}}</td>

                                                <td> <a class='btn btn-raised btn-success btn-sml' href=" {{url('shiftsettings/'.$shiftSettings->id.'/edit')}}" ><i class="icon-edit"></i></a>

                                                </td>


                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>




@endsection
