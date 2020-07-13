
@extends('welcome')
@section('content')


    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('workplace')}}"> {{trans('admin.workplaces')}} </a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.edit')}}
                </li>
            </ol>
        </div>
    </div>

    <div class="card-body" >


        <div class="app-content content container-fluid">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body"><!-- stats -->
                    <div class="row">

                        <div class="card">
                            <div class="card-body">
                                <div class="card-body collapse in">

                                    <div class="card" >
                                        <div class="card-header"   >
                                            <h3 class="card-title">{{trans('admin.edit')}} </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                            {!! Form::model($workplace, ['route' => ['workplaces.update',$workplace->id] , 'method'=>'put' ]) !!}
                                            {!! csrf_field() !!}


                                            <div class="form-group">
                                                <strong>{{trans('admin.workplace_name')}}</strong>
                                                {{ Form::text('workplace_name',$workplace->workplace_name,["class"=>"form-control" ]) }}
                                            </div>

                                            <div class="form-group">
                                                <strong>{{trans('admin.network_name')}}</strong>
                                                {{ Form::text('network_name',$workplace->network_name,["class"=>"form-control" ]) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>mac_address </strong>
                                                {{ Form::text('mac_address',$workplace->mac_address,["class"=>"form-control","placeholder"=>"xx-xx-xx-xx-xx-xx" ]) }}
                                            </div>
                                            <div class="form-group">
                                                <strong>{{trans('admin.notes')}}</strong>
                                                {{ Form::text('notes',$workplace->notes,["class"=>"form-control" ]) }}
                                            </div>







                                            {{ Form::submit( trans('admin.edit') ,['class'=>'btn btn-info']) }}
                                            {{ Form::close() }}
                                        </div>




@endsection
