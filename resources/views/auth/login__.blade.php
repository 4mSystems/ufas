<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
    @php
        $setting =   \App\Setting::orderBy('id','desc')->first()

    @endphp
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    {{--    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">--}}
    {{--    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">--}}
    {{--    <meta name="author" content="PIXINVENT">--}}
    <title>{{$setting->system_name_en}}</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('public/app-assets/images/ico/apple-icon-60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('public/app-assets/images/ico/apple-icon-76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('public/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('public/app-assets/images/ico/apple-icon-152.png')}}">
    <link rel="shortcut icon" type="image/png" href="{{url('public/app-assets/images/ico/ico.jpg')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/bootstrap.css')}}">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/fonts/icomoon.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{url('public/app-assets/fonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/extensions/pace.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/colors.css')}}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{url('public/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{url('public/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/pages/login-register.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/css/style.css')}}">
    <!-- END Custom CSS-->
</head>
<body data-open="click" data-menu="vertical-menu" data-col="1-column"
      class="vertical-layout vertical-menu 1-column  blank-page blank-page"
      style="background-image: url('public/img/3.jpg');background-repeat: no-repeat;
      background-position:center;
        background-size: cover; ">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">

            <section class="flexbox-container">
                <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 m-0">
                        <div class="card-header no-border">
                            <div class="card-title text-xs-center">
                                <div class="p-1"><img src="{{ Storage::url($setting->logo) }}"
                                                      style="width:200px;height:100px;" alt="branding logo"></div>
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Login to {{$setting->system_name_en}}</span>
                            </h6>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block">

                                <form method="POST" action="{{ route('login') }}" class="form-horizontal form-simple"
                                      novalidate>
                                    @csrf

                                    <div class="form-group row">

                                        <fieldset class="form-group position-relative has-icon-left mb-0">

                                            <input id="mobile" type="text"
                                                   class="form-control form-control-lg input-lg @error('mobile') is-invalid @enderror"
                                                   placeholder="Your Mobile" name="mobile"
                                                   value="{{ old('mobile') }}" required autocomplete="mobile"
                                                   autofocus>
                                            <div class="form-control-position">
                                                <i class="icon-mobile"></i>
                                            </div>
                                        </fieldset>

                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>

                                    <div class="form-group row">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input id="password" type="password"
                                                   class="form-control form-control-lg input-lg @error('password') is-invalid @enderror"
                                                   placeholder="Your Password" name="password" required
                                                   autocomplete="current-password">
                                            <div class="form-control-position">
                                                <i class="icon-key3"></i>
                                            </div>
                                        </fieldset>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                    <div class="form-group row">
                                        <div
                                            class="col-md-3 offset-md-4  col-md-6 col-xs-12 text-xs-center text-md-left">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    RememberMe
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <button type="submit" id="submit"
                                                class="btn btn-primary btn-lg btn-block">
                                            <i class="icon-unlock2"></i> {{ __('Login') }}
                                        </button>

                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </section>

        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<!-- BEGIN VENDOR JS-->
<script src="{{url('public/app-assets/js/core/libraries/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/vendors/js/ui/tether.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/js/core/libraries/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('public/app-assets/vendors/js/ui/unison.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/vendors/js/ui/blockUI.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/vendors/js/ui/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/vendors/js/ui/screenfull.min.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/vendors/js/extensions/pace.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<!-- END PAGE VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="{{url('public/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{url('public/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->
</body>
</html>
