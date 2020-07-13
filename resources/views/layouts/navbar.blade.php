<!-- navbar-fixed-top-->


@php
    $setting =   \App\Setting::orderBy('id','desc')->first()

@endphp


<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a
                        class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a>
                </li>
                <!-- here put the logo of website -->
                <li class="nav-item"><a href="{{url('home')}}" class="navbar-brand nav-link"><img alt="branding logo"
                                                                                                  src="{{ Storage::url($setting->logo) }}"
                                                                                                  data-expand="{{ Storage::url($setting->logo) }}"
                                                                                                  data-collapse="{{ Storage::url($setting->logo) }}"
                                                                                                  style="width:200px;height:40px;"
                                                                                                  class="brand-logo"></a>
                </li>
                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile"
                                                                    class="nav-link open-navbar-container"><i
                            class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>


            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    {{--              <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>--}}

                </ul>
                <ul class="nav navbar-nav float-xs-right">
                    <li class="dropdown dropdown-language nav-item">
                        <a id="dropdown-flag" href="#" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">

                            @if(session('lang')=='en')
                                <i class="flag-icon flag-icon-gb"></i><span class="selected-language">English</span></a>
                        @else
                            <i class=""><img src="{{url('public/img/ksa.png')}}"/></i><span class="selected-language">العربيه</span></a>
                        @endif
                        <div aria-labelledby="dropdown-flag" class="dropdown-menu">
                            <a href="{{url('lang/en')}}" class="dropdown-item">
                                <i class="flag-icon flag-icon-gb"></i> English</a>
                            <a href="{{url('lang/ar')}}" class="dropdown-item">
                                <i class=""><img src="{{url('public/img/ksa.png')}}"/></i> العربيه</a>


                        </div>
                    </li>

                    <li class="dropdown dropdown-notification nav-item"><a href="#" data-toggle="dropdown"
                                                                           class="nav-link nav-link-label"><i
                                class="ficon icon-mail6"></i>

                            @if( count(auth()->user()->notifications) > 0)
                                 <span class="tag tag-pill tag-default tag-info tag-default tag-up">
                                        {{count(auth()->user()->unreadNotifications) }}
                                 </span>
                            @endif</a>

                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notification</span><span
                                        class="notification-tag tag tag-default tag-info float-xs-right m-0"></span>
                                </h6>
                            </li>
                            <li class="list-group scrollable-container">
                                @foreach(auth()->user()->unReadNotifications as $notify)
                                    <a href="{{$notify->data['link']}}"
                                       class="list-group-item">
                                        <div class="media">

                                            <div class="media-body">
                                                <h6 class="media-heading">{{$notify->data['user_id']}}</h6>
                                                <p class="notification-text font-small-3 text-muted">{{$notify->data['description']}}
                                                    .</p>
                                                <small>
                                                    <date>{{$notify->data['request_date']}}
                                                    </date>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                            </li>
                            @endforeach


                        </ul>
                    </li>
                    @php
                        $employees = \App\User::find(auth()->user()->id);
                        $job = $employees->getJob->name;
                    @endphp
                    <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown"
                                                                   class="dropdown-toggle nav-link dropdown-user-link"><span
                                class="avatar avatar-online"><i></i></span><span class="user-name">{{auth()->user()->name}}  <br> {{$job}}</span></a>
                        <div class="dropdown-menu dropdown-menu-right"><a href="{{url('editprofile')}}" class="dropdown-item"><i
                                    class="icon-head"></i> {{trans('admin.EditProfile')}}</a><a href="#"
                                                                                                class="dropdown-item"><i
                                    class="icon-mail6"></i>{{trans('admin.MyInbox')}} </a>


                            <div class="dropdown-divider"></div>

                            <a href="{{ route('logout') }}" type='submit' class="dropdown-item"

                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{trans('admin.logout')}}

                                <i class="icon-power3"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- ////////////////////////////////////////////////////////////////////////////-->


<!-- main menu-->
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
    <!-- main menu header-->

    <!-- / main menu header-->
    <!-- main menu content-->
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <br>
            <li class=" nav-item"><a href="{{route('home')}}"><i class="icon-home3"></i><span data-i18n="nav.dash.main"
                                                                                              class="menu-title">{{trans('admin.Dashboard')}}</span></a>

            </li>
            <li class=" nav-item"><a href="#"><i class="icon-user"></i><span data-i18n="nav.page_layouts.main"
                                                                             class="menu-title">    {{trans('admin.MainList')}}</span></a>
                <ul class="menu-content">
                    <li><a href="{{url('askpermission')}}" data-i18n="nav.page_layouts.1_column"
                           class="menu-item icon-android-add ">
                            <strong>{{trans('admin.PermissionRequest')}}</strong></a>

                    </li>
                    <li><a href="{{url('vacationrequest')}}" data-i18n="nav.page_layouts.1_column"
                           class="menu-item icon-android-add "> <strong>{{trans('admin.VacationRequest')}}</strong></a>

                    </li>

                    @php
                        $job_id=auth()->user()->job_id;
                        $job = App\Job::where('id',$job_id)->first();

                    if($job->enabled == 'yes'){

                    @endphp


                    <li><a href="{{url('requestslist')}}" data-i18n="nav.page_layouts.2_columns"
                           class="menu-item icon-css32"> <strong>{{trans('admin.permissionList')}}</strong></a>
                    </li>

                    @php
                        }
                        @endphp

                    <li><a href="{{url('myrequets')}}" data-i18n="nav.page_layouts.boxed_layout"
                           class="menu-item icon-dropbox2"> <strong>{{trans('admin.followRequest')}}</strong></a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="icon-bar-graph-2"></i><span data-i18n="nav.project.main"
                                                                                    class="menu-title">{{trans('admin.Reportsandstatistics')}}</span></a>
                <ul class="menu-content">
                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->Archievs;
                        if($enabled == 'yes'){

                    @endphp
                    <li><a href="{{url('archievs')}}" data-i18n="nav.invoice.invoice_template" class="menu-item icon-pie-graph2 ">
                            <strong>{{trans('admin.Archievs')}}</strong></a>
                    </li>
                    @php
                        }
                    @endphp

                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->dailyreport;
                        if($enabled == 'yes'){

                    @endphp
                    <li><a href="{{url('dailyreport')}}" data-i18n="nav.gallery_pages.gallery_grid" class="menu-item icon-android-clipboard">
                            <strong>{{trans('admin.dailyReport')}}</strong></a>
                    </li>
                    @php
                        }
                    @endphp
                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->mothlyreport;
                        if($enabled == 'yes'){

                    @endphp
                    <li><a href="{{url('mothlyreport')}}" data-i18n="nav.search_pages.search_page" class="menu-item icon-android-document">
                            <strong>{{trans('admin.monthlyReport')}}</strong></a>
                    </li>
                    @php
                        }
                    @endphp

                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="icon-android-desktop"></i><span data-i18n="nav.cards.main"
                                                                                        class="menu-title">{{trans('admin.controlPanel')}}</span></a>
                <ul class="menu-content">


                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->overtimePage;
                        if($enabled == 'yes'){

                    @endphp

                    <li><a href="{{url('bonuses')}}" data-i18n="nav.cards.card_actions"
                           class="menu-item icon-social-bitcoin">
                            <strong>{{trans('admin.overtimeSettings')}}</strong></a>
                    </li>
                    @php
                         }
                    @endphp



                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->jobsPage;
                        if($enabled == 'yes'){

                    @endphp

                <!-- code here -->
                    <li><a href="{{url('jobs')}}" data-i18n="nav.cards.card_actions" class="menu-item icon-university">
                            <strong>{{trans('admin.jobsSettings')}}</strong></a>
                    </li>


                    @php
                        }
                    @endphp

                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->employeePage;
                        if($enabled == 'yes'){

                    @endphp

                    <li><a href="{{url('employee')}}" data-i18n="nav.cards.card_actions"
                           class="menu-item icon-ios-people"> <strong>{{trans('admin.employeeSettings')}}</strong></a>
                    </li>

                    @php
                        }
                    @endphp


                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->departmentPage;
                        if($enabled == 'yes'){

                    @endphp
                    <li><a href="{{url('departments')}}" class="menu-item icon-ei-tag">
                            <strong>{{trans('admin.departments')}}</strong></a>
                    </li>
                    @php
                        }
                    @endphp


                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->vacations;
                        if($enabled == 'yes'){

                    @endphp

                    <li><a href="{{url('vacations')}}" class="menu-item icon-briefcase4">
                            <strong>{{trans('admin.Vacationsandpermissions')}}</strong></a>
                    </li>
                    @php
                        }
                    @endphp

                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->workplaces;
                        if($enabled == 'yes'){

                    @endphp
                    <li><a href="{{url('workplaces')}}" class="menu-item icon-location4">
                            <strong>{{trans('admin.workplace')}}</strong></a>
                    </li>
                    @php
                        }
                    @endphp

                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->officialvacations;
                        if($enabled == 'yes'){

                    @endphp
                    <li><a href="{{url('officialvacations')}}" class="menu-item icon-help2">
                            <strong>{{trans('admin.officialvacations')}}</strong></a>
                    </li>
                    @php
                        }
                    @endphp

                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->shifts;
                        if($enabled == 'yes'){

                    @endphp
                    <li><a href="{{url('shifts')}}" class="menu-item icon-android-time">
                            <strong>{{trans('admin.shifts')}}</strong></a>
                    </li>
                    @php
                        }
                    @endphp

                    @php
                        $user_id=auth()->user()->id;
                        $permission =App\Permission::where('user_id',$user_id)->first();
                        $enabled= $permission->settings;
                        if($enabled == 'yes'){

                    @endphp
                    <li><a href="{{url('settings')}}" class="menu-item icon-android-options">
                            <strong>{{trans('admin.settings')}}</strong></a>
                    </li>
                    @php
                        }
                    @endphp

                </ul>
            </li>


        </ul>
    </div>
    <!-- /main menu content-->
    <!-- main menu footer-->
    <!-- include includes/menu-footer-->
    <!-- main menu footer-->
    

</div>
<!-- / main menu-->
