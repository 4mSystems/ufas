
@extends('welcome')
@section('content')
    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('officialvacations')}}"> {{trans('admin.officialvacations')}} </a>
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

                                            {!! Form::open(['url' => ['officialvacations'] , 'method'=>'post']) !!}
                                            {!! csrf_field() !!}


                                            <div class="form-group">
                                                <strong>{{trans('admin.vacation_name')}}</strong>
                                                {{ Form::text('name',old('name'),["class"=>"form-control" ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.vacation_date')}}</strong>
                                                {{ Form::date('vacation_date',old('vacation_date'),["class"=>"form-control"]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.notes')}}</strong>
                                                {{ Form::text('notes',old('notes'),["class"=>"form-control" ]) }}
                                            </div>



                                            {{ Form::submit( trans('admin.Add') ,['class'=>'btn btn-info']) }}
                                            {{ Form::close() }}




                                        </div>



@endsection
