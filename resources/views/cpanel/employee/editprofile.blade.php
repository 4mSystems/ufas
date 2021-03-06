@extends('welcome')

@section('content')
    <br>

    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>

                <li class="breadcrumb-item"> {{trans('admin.editprofile')}}
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

                                    <div class="card" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                        <div class="card-header">
                                            <h3 class="card-title">{{trans('admin.edit')}} </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>

                                            {!! Form::model($employee, ['url' => ['editprofile'] , 'method'=>'post' ,'files'=> true]) !!}
                                            {{ csrf_field() }}


                                            <div class="form-group">
                                                <strong>{{trans('admin.empName')}}</strong>
                                                {{ Form::text('name',$employee->name,["class"=>"form-control" ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.mobile')}}</strong>
                                                {{ Form::number('mobile',$employee->mobile,["class"=>"form-control" ,'max'=>'9999999999999'   ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.address')}}</strong>
                                                {{ Form::text('address',$employee->address,["class"=>"form-control"  ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.email')}}</strong>
                                                {{ Form::email('email',$employee->email,["class"=>"form-control"  ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.password')}}</strong>
                                                {{ Form::password('password',["class"=>"form-control"  ]) }}
                                            </div>

                                            {{ Form::submit( trans('admin.edit') ,['class'=>'btn btn-info']) }}
                                            {{ Form::close() }}
                                        </div>




@endsection
