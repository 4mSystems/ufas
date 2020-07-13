
@extends('welcome')
@section('content')
 
<div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div> 
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li> 
              </ol>
            </div>
         


        <div class="content-body">
        
        <!-- stats -->
       
<div class="row">
@php
        $user_id = auth()->user()->id;
        if($user_id == 1){
        @endphp
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
        
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="pink">{{$emps}}</h3>
                            <span>{{trans('admin.totalemployees')}}</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-users3 pink font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="teal">{{$vacationRequest}}</h3>
                            <span>{{trans('admin.totalvacations')}}</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-briefcase3 teal font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="deep-orange">{{$askpermission}}</h3>
                            <span>{{trans('admin.totalpermissions')}}</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-outdent deep-orange font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="cyan">{{$depts}}</h3>
                            <span>{{trans('admin.totaldepts')}}</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-server cyan font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        }

@endphp
</div>

<div class="row">
    <div class="">
        <div class="card">

            <div class="card-footer">
                <div class="row">
                    <div class="col-xs-2 text-xs-center">
                        <span class="text-muted">{{trans('admin.totalabsence')}}</span>
                        <h2 class="block font-weight-normal">{{$total_absence_h->total}}</h2>
                        <progress class="progress progress-xs mt-2 progress-success" value="{{$total_absence_h->total}}" max="60"></progress>
                    </div>

                    <div class="col-xs-2 text-xs-center">
                        <span class="text-muted">{{trans('admin.totalnoattendance')}}</span>
                        <h2 class="block font-weight-normal">{{$no_attendance_count_h->total}}</h2>
                        <progress class="progress progress-xs mt-2 progress-success" value="{{$no_attendance_count_h->total}}" max="60"></progress>
                    </div>
                    <div class="col-xs-2 text-xs-center">
                        <span class="text-muted">{{trans('admin.totalnoleave')}}</span>
                        <h2 class="block font-weight-normal">{{$no_leave_count_h->total}}</h2>
                        <progress class="progress progress-xs mt-2 progress-success" value="{{$no_leave_count_h->total}}" max="60"></progress>

                    </div>
                    <div class="col-xs-2 text-xs-center">
                        <span class="text-muted">{{trans('admin.totalovertime')}}</span>
                        <h2 class="block font-weight-normal">{{date('H:i', strtotime($total_overtime_h))}}
</h2>
                        <progress class="progress progress-xs mt-2 progress-success" value="15" max="60"></progress>

                    </div>
                    <div class="col-xs-2 text-xs-center">
                        <span class="text-muted">{{trans('admin.totalattendancedelay')}}</span>
                        @if($total_attendance_delay_h->total ==null)
                        <h2 class="block font-weight-normal">0</h2>
                        @else
                        <h2 class="block font-weight-normal">{{date('H:i', strtotime($total_attendance_delay_h->total))}}</h2>
                        @endif
                        <progress class="progress progress-xs mt-2 progress-success" value="10" max="60"></progress>

                    </div>
                    <div class="col-xs-2 text-xs-center">
                        <span class="text-muted">{{trans('admin.totalleaveearly')}}</span>
                        @if($total_leave_early_h->total ==null)
                        <h2 class="block font-weight-normal">0</h2>
                        @else 
                        <h2 class="block font-weight-normal">{{date('H:i', strtotime($total_leave_early_h->total))}}</h2>
                        @endif
                        <progress class="progress progress-xs mt-2 progress-success" value="10" max="60"></progress>

                    </div>





                </div>
            </div>
        </div>
    </div>

</div>










@endsection
