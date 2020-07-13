
@extends('welcome')
@section('content')


    <br>
    <!-- /.card-header -->
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.shifts')}}
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

                                    <h3 class="card-title">{{trans('admin.shifts')}} </h3>
                                </div>


                                <div class="" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <a href="{{url('shifts/create')}}  " class="btn btn-info btn-bg">{{trans('admin.createtitle')}} </a>
                                </div >

                                <div class="table-responsive" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <table class="table">
                                        <thead class="bg-info">
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('admin.shiftname')}}</th>
                                            <th>{{trans('admin.delay')}}</th>
                                            <th>{{trans('admin.leave')}}</th>
                                            <th>{{trans('admin.shiftsettings')}} </th>
                                            <th> </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($shifts as $shifts)
                                            <tr>
                                                <th scope="row">{{$shifts->id}}</th>
                                                <td>{{$shifts->name}}</td>


                                                <td>{{$shifts->delayallowed}}</td>


                                                <td>{{$shifts->leaveallowed}} </td>

                                                <td> <a class='btn btn-raised btn-success btn-sml' href=" {{url('shiftsettings/'.$shifts->id)}}" ><i class="icon-android-settings"></i></a>

                                                <td> <a class='btn btn-raised btn-success btn-sml' href=" {{url('shifts/'.$shifts->id.'/edit')}}" ><i class="icon-edit"></i></a>

                                                    <form method="get" id='delete-form-{{ $shifts->id }}' action="{{url('shifts/'.$shifts->id.'/delete')}}"
                                                          style='display: none;'>
                                                    {{csrf_field()}}
                                                    <!-- {{method_field('delete')}}   -->
                                                    </form>
                                                    <button onclick="if(confirm('are you sure to delete this record?'))
                                                        {
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $shifts->id }}').submit();
                                                        }else {
                                                        event.preventDefault();
                                                        }

                                                        "
                                                            class='btn btn-raised btn-danger btn-sml' href=" "><i class="icon-android-delete" aria-hidden='true'>
                                                        </i >


                                                    </button>
                                                </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>




@endsection
