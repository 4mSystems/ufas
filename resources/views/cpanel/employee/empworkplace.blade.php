
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
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item">   <a href="{{url('employee')}}">{{trans('admin.employee')}}</a>
                </li>
                <li class="breadcrumb-item">{{trans('admin.empworkplaces')}}
                </li>

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

                            <div class="card-body collapse in">


                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <h3 class="card-title">{{trans('admin.empworkplaces')}} </h3>
                                </div>


                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>

                                        {{ Form::open( ['url' => ['empworkplace/'.$emp->id],'method'=>'post'] ) }}
                                         {{ csrf_field() }}

                                    @foreach($workplaces as $workplaces)
{{--                                       {{ Form::select('workplaces[]', $workplaces,App\Workplace::pluck('workplace_name','id'), ['multiple']) }}--}}

                                        <div class="form-group">
                                            <strong>{{$workplaces->workplace_name}}</strong>
                                            <div style="padding-right: 50px">
                                            <label class="switch">
                                                <input type="hidden" name="workplace_id" id='workplace_id'>
                                                {{ Form::checkbox('workplaces[]',   $workplaces->id , in_array($workplaces->id, $old_workplaces)?true:false)  }}

                                                <span class="slider round"></span>
                                            </label>
                                            </div>
                                        </div>
                                    @endforeach
                                        {{ Form::submit( trans('admin.edit') ,['class'=>'btn btn-info']) }}
                                        {{ Form::close() }}
                                </div>

                                </div>
                            </div>
                        </div>




@endsection
