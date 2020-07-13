
@extends('welcome')

@section('content')





    <div class="card-body">
        <br>
        <div class="app-content content container-fluid">
            <div class="breadcrumb-wrapper col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                    </li>

                    <li class="breadcrumb-item"> {{trans('admin.settings')}}
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
                                            <h3 class="card-title">{{trans('admin.settings')}} </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">

        <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
            {!! Form::model($setting, ['url' => ['settings'] , 'method'=>'post' ,'files'=> true]) !!}

            <div class="form-group">
                {{ Form::label('system_name_ar',trans('admin.system_name_ar') ) }}
                {{ Form::text('system_name_ar',$setting->system_name_ar,["class"=>"form-control"]) }}
            </div>

            <div class="form-group">
                {{ Form::label('system_name_en',trans('admin.system_name_en') ) }}
                {{ Form::text('system_name_en',$setting->system_name_en,["class"=>"form-control"]) }}
            </div>

            <div class="form-group">
                {{ Form::label('contacts',trans('admin.contacts') ) }}
                {{ Form::textarea('contacts',$setting->contacts,["class"=>"form-control"]) }}
            </div>

            <div class="form-group">

                {{ Form::label('logo',trans('admin.logo')) }}
                {{ Form::file('logo' ,["class"=>"form-control"]) }}
                @if(!empty($setting->logo))
                    <img src="{{ Storage::url($setting->logo) }}" style="width:250px;height:250px;" />

                @endif
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
