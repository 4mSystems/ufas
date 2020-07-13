
@php
    $setting =   \App\Setting::orderBy('id','desc')->first()

@endphp

<link rel="shortcut icon" type="image/png" href="{{Storage::url($setting->logo)}}">
{{--@yield('css')--}}
<!-- Basic Css files -->
<link href="{{url('public/login/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{url('public/login/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{url('public/login/css/style.css') }}" rel="stylesheet" type="text/css">
