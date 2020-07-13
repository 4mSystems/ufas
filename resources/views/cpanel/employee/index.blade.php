
@extends('welcome')
@section('content')
<br>
<div class="app-content content container-fluid">
                  <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item">
              <a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.employee')}}
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
    <h3 class="card-title">{{trans('admin.employee')}} </h3>
    </div>


    <div class="" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                <a href="{{url('employee/create')}}  " class="btn btn-info btn-bg">{{trans('admin.createtitle')}} </a>
                </div >

                <div class="table-responsive" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                    <table class="table">
                        <thead class="bg-info">
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.empname')}}</th>
                                <th>{{trans('admin.department')}}</th>
                                <th>{{trans('admin.job')}}</th>
                                <th>{{trans('admin.workplace')}} </th>
                                <th>{{trans('admin.shifts')}} </th>
                                <th> </th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employees)
                            <tr>
                                <th scope="row">{{$employees->id}}</th>
                                <td>{{$employees->name}}</td>
                                <td>{{$employees->getDepartment->name}}</td>
                                <td>{{$employees->getJob->name}} </td>
                                <td> <a class='btn btn-raised btn-success btn-sml' href=" {{url('empworkplace/'.$employees->id)}}" ><i class="icon-ios-location"></i></a>
                                <td> <a class='btn btn-raised btn-success btn-sml' href=" {{url('empshifts/'.$employees->id)}}" ><i class="icon-ios-time-outline"></i></a>

                                <td> <a class='btn btn-raised btn-success btn-sml' href=" {{url('employee/'.$employees->id.'/edit')}}" ><i class="icon-edit"></i></a>

                      <form method="get" id='delete-form-{{ $employees->id }}' action="{{url('employee/'.$employees->id.'/delete')}}"
                      style='display: none;'>
                      {{csrf_field()}}
                      <!-- {{method_field('delete')}}   -->
                      </form>
                      <button onclick="if(confirm('are you sure to delete this record?'))
                      {
                          event.preventDefault();
                          document.getElementById('delete-form-{{ $employees->id }}').submit();
                      }else {
                            event.preventDefault();
                      }

                      "
                  class='btn btn-raised btn-danger btn-sml' href=" "><i class="icon-android-delete" aria-hidden='true'>
                    </i >


                    </button>

                      @php
                         $user_id=auth()->user()->id;
                         $permission =App\Permission::where('user_id',$user_id)->first();
                         $enabled= $permission->permissionPage;
                         if($enabled == 'yes'){

                        @endphp


                    <a class='btn btn-raised btn-success btn-sml' href=" {{url('permission/'.$employees->id.'/edit')}}" >{{trans('admin.permissions')}}<i class="icon-edit"></i></a>
                    @php
                         }
                    @endphp
                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

</div>
</div>
</div>




@endsection
