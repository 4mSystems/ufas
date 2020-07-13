@extends('welcome')
@section('content')





    <div class="card-body">
        <br>
        <div class="app-content content container-fluid">
            <div class="breadcrumb-wrapper col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                    </li>

                    <li class="breadcrumb-item"> {{trans('admin.Vacationsandpermissions')}}
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

                                    <div class="card">
                                        <div class="card-header" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                            <h3 class="card-title">{{trans('admin.Vacationsandpermissions')}} </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">

                                            <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                                {!! Form::model($vacations, ['url' => ['vacations'] , 'method'=>'post' ]) !!}

                                                <div class="form-group">
                                                    {{ Form::label('annual',trans('admin.annual') ) }}
                                                    {{ Form::number('annual',$vacations->annual,["class"=>"form-control"  , 'step' => 'any' ,'max'=>'100' ]) }}
                                                </div>

                                                <div class="form-group">
                                                    {{ Form::label('monthly',trans('admin.monthly') ) }}
                                                    {{ Form::number('monthly',$vacations->monthly,["class"=>"form-control"  , 'step' => 'any' ,'max'=>'100' ]) }}
                                                </div>

                                                <div class="form-group">
                                                    {{ Form::label('daily',trans('admin.daily') ) }}
                                                    {{ Form::number('daily',$vacations->daily,["class"=>"form-control"  , 'step' => 'any' ,'max'=>'100' ]) }}
                                                </div>

                                                <div style =' padding-top: 10px;
                                                    padding-right: 15px;
                                                     padding-left: 20px;
                                                     '>
                                                    {{ Form::submit(trans('admin.edit'),['class'=>'btn btn-info']) }}

                                                </div>
                                                {{ Form::close() }}
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->








@endsection
