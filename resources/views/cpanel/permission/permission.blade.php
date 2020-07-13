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



    <div class="card-body">
        <br>
        <div class="app-content content container-fluid">
            <div class="breadcrumb-wrapper col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{url('employee')}}">{{trans('admin.employee')}}</a>
                    </li>
                    <li class="breadcrumb-item"> {{trans('admin.permissions')}}
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
                                            <h3 class="card-title">{{trans('admin.edit')}} </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>


                                            {!! Form::model($permission, ['route' => ['permission.update',$permission->id] , 'method'=>'put' ,'files'=> true]) !!}
                                            {{ csrf_field() }}


                                            <div class="form-group">
                                                <strong>{{trans('admin.empName')}}</strong>
                                                {{ Form::label('user_id',$permission->getUser->name,
                                                    $permission->user_id
                                                ,["class"=>"form-control " ]) }}
                                            </div>


                                            <div class="form-group">


                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                        <tr>
                                                            <th>
                                                                <div class="form-group" style="padding: 25px;">
                                                                    <strong>{{trans('admin.cpanel')}}</strong>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                        <tr>

                                                            <th>{{trans('admin.overtimePage')}}</th>
                                                            <td>
                                                            <!-- <strong>{{trans('admin.overtimePage')}}</strong>       -->
                                                            <!-- {!! Form::select('overtimePage', ['yes'=>trans('admin.yes') , 'no'=>trans('admin.no')] , $permission->overtimePage, ['class'=>'form-control',null]) !!} -->


                                                                <label class="switch">
                                                                    <input type="hidden" name="overtimePage"
                                                                           id='overtimePage' value="no">
                                                                    {{ Form::checkbox('overtimePage', 'yes',  $permission->overtimePage=="yes"?true:false) }}

                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </td>
                                                        </tr>


                                                </div>

                                                <div class="form-group">
                                                    <tr>
                                                        <th>{{trans('admin.jobsPage')}}</th>
                                                        <td>
                                                        <!-- <strong>{{trans('admin.jobsPage')}}</strong>  -->
                                                        <!-- {!! Form::select('jobsPage', ['yes'=>trans('admin.yes') , 'no'=>trans('admin.no')] , $permission->jobsPage, ['class'=>'form-control',null]) !!} -->


                                                            <label class="switch">

                                                                <input type="hidden" name="jobsPage" id='jobsPage'
                                                                       value="no">
                                                                {{ Form::checkbox('jobsPage', 'yes',  $permission->jobsPage=="yes"?true:false) }}
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <tr>
                                                    <th>{{trans('admin.employeePage')}}</th>
                                                    <td>
                                                    <!-- {!! Form::select('employeePage', ['yes'=>trans('admin.yes') , 'no'=>trans('admin.no')], $permission->employeePage, ['class'=>'form-control',null]) !!} -->

                                                        <label class="switch">
                                                            <input type="hidden" name="employeePage" id='employeePage'
                                                                   value="no">
                                                            {{ Form::checkbox('employeePage', 'yes',  $permission->employeePage=="yes"?true:false) }}
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <tr>
                                                <th>{{trans('admin.departmentPage')}}</th>
                                            <!-- {!! Form::select('departmentPage', ['yes'=>trans('admin.yes') , 'no'=>trans('admin.no')] , $permission->departmentPage, ['class'=>'form-control',null]) !!} -->
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="departmentPage" id='departmentPage'
                                                               value="no">
                                                        {{ Form::checkbox('departmentPage', 'yes',  $permission->departmentPage=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>


                                        <div class="form-group">
                                            <tr>
                                                <th>{{trans('admin.permissionPage')}}</th>
                                            <!-- {!! Form::select('permissionPage', ['yes'=>trans('admin.yes') , 'no'=>trans('admin.no')], $permission->permissionPage, ['class'=>'form-control',null]) !!} -->
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="permissionPage" id='permissionPage'
                                                               value="no">
                                                        {{ Form::checkbox('permissionPage', 'yes',  $permission->permissionPage=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>


                                        <div class="form-group">
                                            <tr>
                                                <th>{{trans('admin.Vacationsandpermissions')}}</th>
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="vacations" id='vacations' value="no">
                                                        {{ Form::checkbox('vacations', 'yes',  $permission->vacations=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>

                                        <div class="form-group">
                                            <tr>
                                                <th>{{trans('admin.workplace')}}</th>
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="workplaces" id='workplaces'
                                                               value="no">
                                                        {{ Form::checkbox('workplaces', 'yes',  $permission->workplaces=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>

                                        <div class="form-group">
                                            <tr>
                                                <th>{{trans('admin.officialvacations')}}</th>
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="officialvacations"
                                                               id='officialvacations' value="no">
                                                        {{ Form::checkbox('officialvacations', 'yes',  $permission->officialvacations=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>

                                        <div class="form-group">
                                            <tr>
                                                <th>{{trans('admin.shifts')}}</th>
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="shifts" id='shifts' value="no">
                                                        {{ Form::checkbox('shifts', 'yes',  $permission->shifts=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>

                                        <div class="form-group">
                                            <tr>
                                                <th>{{trans('admin.settings')}}</th>
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="settings" id='settings' value="no">
                                                        {{ Form::checkbox('settings', 'yes',  $permission->settings=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>

                                        <div class="form-group">
                                            <tr>
                                                <th>
                                                    <div class="form-group" style="padding: 25px;">
                                                        <strong>{{trans('admin.Reportsandstatistics')}}</strong>
                                                    </div>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>{{trans('admin.Archievs')}}</th>
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="Archievs" id='Archievs' value="no">
                                                        {{ Form::checkbox('Archievs', 'yes',  $permission->Archievs=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>

                                        <div class="form-group">
                                            <tr>
                                                <th>{{trans('admin.dailyreport')}}</th>
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="dailyreport" id='dailyreport'
                                                               value="no">
                                                        {{ Form::checkbox('dailyreport', 'yes',  $permission->dailyreport=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>

                                        <div class="form-group">
                                            <tr>
                                                <th>{{trans('admin.mothlyreport')}}</th>
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="mothlyreport" id='mothlyreport'
                                                               value="no">
                                                        {{ Form::checkbox('mothlyreport', 'yes',  $permission->mothlyreport=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>


                                        <div class="form-group">
                                            <tr>
                                                <th>{{trans('admin.archievesEdit')}}</th>
                                            <!-- {!! Form::select('archievesEdit', ['yes'=>trans('admin.yes') , 'no'=>trans('admin.no')], $permission->archievesEdit, ['class'=>'form-control',null]) !!} -->
                                                <td>
                                                    <label class="switch">

                                                        <input type="hidden" name="archievesEdit" id='archievesEdit'
                                                               value="no">
                                                        {{ Form::checkbox('archievesEdit', 'yes',  $permission->archievesEdit=="yes"?true:false) }}
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                            </tr>
                                        </div>

                                        </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- test -->


                        <!-- Rounded switch -->


                        <!-- end test -->
                        <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                            {{ Form::submit( trans('admin.edit') ,['class'=>'btn btn-info']) }}
                        </div>
                        {{ Form::close() }}
                    </div>




@endsection
