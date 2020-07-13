@extends('welcome')
@section('content')
    <br>
    <div class="app-content content container-fluid">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('archievs')}}">{{trans('admin.Archievs')}}
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

                                {!! Form::open(['url' => ['archievs'] , 'method'=>'post']) !!}
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
                                        <option value="all">{{trans('admin.allemployees')}}</option>


                                        @foreach($emp as $user)
                                            <option value="{{$user->id}}">"{{$user->name}}"</option>

                                        @endforeach
                                    </select>
                                </div>

                                {{ Form::submit( trans('admin.search') ,['class'=>'btn btn-info']) }}
                                {{ Form::close() }}


                            </div>


                            <div class="card-body collapse in">


                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <h3 class="card-title">{{trans('admin.Archievs')}} </h3>
                                </div>

                                @if($permission->archievesEdit == 'yes')

                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <a id="createattend" class="btn btn-info">{{trans('admin.Add')}} </a>
                                </div>
                                @endif

                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <button id="upload_file" class="btn btn-info">{{trans('admin.upload')}} </button>
                                </div>
                                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             text-align: center;
                             '>
                                <h3>ارشيف الحضور والانصراف</h3>
                                </div>
                                <div style="text-align: center;">
                                    <h4>من {{$from_date}} الى {{$to_date}}
                                        @if($users == "all")
                                        ({{trans('admin.all')}})
                                            @else
                                     ({{$users->name}})
                                        @endif
                                    </h4>
                                </div>

                                <div class="table-responsive" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                                    <table class="table">
                                        <thead class="bg-info">
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('admin.empname')}}</th>
                                            <th>{{trans('admin.datee')}} </th>
                                            <th>{{trans('admin.checktime')}}</th>
                                            <th>{{trans('admin.image')}}</th>
                                            <th></th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $id = 1;
                                        @endphp

                                        @foreach($attendances as $attendance)
                                            <tr>
                                                <th scope="row">{{$id}}</th>
                                                <td>{{$attendance->getUser->name}}</td>
                                                <td>{{$attendance->check_date}} </td>
                                                <td>{{ date('H:i', strtotime($attendance->check_time))}} </td>


                                                <td>
                                                    @if($attendance->image != null)
                                                    <a href="{{url('public/'.$attendance->image)}}" target="_blank">
                                                        <img style="width: 25px;height: 15px"
                                                             src="{{url('public/'.$attendance->image)}}"></a></td>
                                                    @endif

                                                </td>

                                                @if($permission->archievesEdit == 'yes')

                                                <td> <a class='btn btn-raised btn-success btn-sml' data-attendid="{{$attendance->id}}" id="edit_attend"><i class="icon-edit"></i></a>




                                                    <form method="get" id='delete-form-{{ $attendance->id }}' action="{{url('archievs/'.$attendance->id.'/delete')}}"
                                                          style='display: none;'>
                                                    {{csrf_field()}}
                                                    <!-- {{method_field('delete')}}   -->
                                                    </form>
                                                    <button onclick="if(confirm('are you sure to delete this record?'))
                                                        {
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $attendance->id }}').submit();
                                                        }else {
                                                        event.preventDefault();
                                                        }

                                                        "
                                                            class='btn btn-raised btn-danger btn-sml' href=" "><i class="icon-android-delete" aria-hidden='true'>
                                                        </i >


                                                    </button>
                                                </td>
                                                    @endif


                                            </tr>
                                            @php
                                                $id++;
                                            @endphp

                                        @endforeach

                                        </tbody>

                                    </table>

                                </div>  
                            </div>

</div>
                        </div>
                        </div>  


                        <!-- create new attendance -->
                        <div id="createModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <h4 align="center" class="card-title" style="margin:0;">{{trans('admin.Add')}}</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">

                                                {!! Form::open(['url' => ['addarchievs'] , 'method'=>'post']) !!}
                                                {!! csrf_field() !!}

                                                <div class="form-group">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <strong>{{trans('admin.empname')}}</strong>

                                                        <select name="user_id" id="user_id" class='form-control'>

                                                            @foreach($emp as $user)
                                                                <option value="{{$user->id}}">"{{$user->name}}"</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <strong>{{trans('admin.datee')}}</strong>
                                                        {{ Form::date('check_date',old('check_date'),["class"=>"form-control" ]) }}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <strong>{{trans('admin.time')}}</strong>
                                                        {{ Form::time('check_time',old('check_time'),["class"=>"form-control" ]) }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        {{ Form::submit( trans('admin.Add') ,['class'=>'btn btn-info']) }}
                                                        <button data-dismiss="modal" class="btn btn-danger" type="button">
                                                            {{trans('admin.close')}}
                                                        </button>
                                                    </div>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
    <div id="uploadModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <h4 align="center" class="card-title" style="margin:0;">{{trans('admin.upload')}}</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">

                                                {!! Form::open(['url' => ['import'] ,"files"=>'true','method'=>'post']) !!}
                                                {!! csrf_field() !!}

                                                <div class="form-group">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <strong>{{trans('admin.empname')}}</strong>

                                                        <select name="employee_id" id="employee_id" class='form-control'>

                                                            @foreach($emp as $user)
                                                                <option value="{{$user->id}}">"{{$user->name}}"</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                                                        <input type="file" name="file" id="file">
                                                    </div>
                                                </div>

                                               
                                                <div class="modal-footer">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        {{ Form::submit( trans('admin.upload') ,['class'=>'btn btn-info']) }}
                                                        <button data-dismiss="modal" class="btn btn-danger" type="button">
                                                            {{trans('admin.close')}}
                                                        </button>
                                                    </div>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <!-- edit  attendance -->
                    <div id="editModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-body">
                                    <h4 align="center" class="card-title" style="margin:0;">{{trans('admin.edit')}}</h4>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">

                                            {!! Form::open(['url' => ['updatearchievs'] , 'method'=>'post']) !!}
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="id" id='id' value=''/>
                                            <div class="form-group">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <strong>{{trans('admin.empname')}}</strong>

                                                    <select name="user_id" id="userid" class='form-control'>

                                                        @foreach($emp as $user)
                                                            <option value="{{$user->id}}">"{{$user->name}}"</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <strong>{{trans('admin.datee')}}</strong>
                                                     {{ Form::date('check_date', old('check_date'),["class"=>"form-control" ,"id"=>"date"]) }}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <strong>{{trans('admin.time')}}</strong>
                                                     {{ Form::time('check_time',old('check_time'),["class"=>"form-control" ,"id"=>"check_time"]) }}
                                                </div>
                                            </div>
                                            <br><br><br><br><br><br><br><br>
                                            <div class="modal-footer">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    {{ Form::submit( trans('admin.edit') ,['class'=>'btn btn-info']) }}
                                                    <button data-dismiss="modal" class="btn btn-danger" type="button">
                                                        {{trans('admin.close')}}
                                                    </button>
                                                </div>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
 
                                </div>













 <!-- create new attendance -->




                @endsection
                    @push('js')
                        <script>

                            $('#upload_file').click(function () {
                                $('#uploadModal').modal('show');
                            });

                            $('#createattend').click(function () {
                                $('#createModal').modal('show');
                            });

                            var id;
                            $(document).on('click', '#edit_attend', function () {
                                id =  $(this).data('attendid');

                                $.ajax({
                                    url: "archievs/" + id + "/edit",
                                    dataType: "json",
                                    success: function (html) {
                                        $('#userid').val(html.data.user_id);
                                        $('#id').val(html.data.id);
                                        $('#date').val(html.data.check_date);
                                        $('#check_time').val(html.data.check_time);
                                        $('#editModal').modal('show');



                                    }
                                })
                            });


                        </script>




    @endpush

