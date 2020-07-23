<!DOCTYPE html>

@if(session('lang')=='en')
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
      @php
          $setting =   \App\Setting::orderBy('id','desc')->first()

      @endphp
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{$setting->system_name_en}}</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('public/app-assets/images/ico/apple-icon-60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('public/app-assets/images/ico/apple-icon-76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('public/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('public/app-assets/images/ico/apple-icon-152.png')}}">
 

    <link rel="shortcut icon" type="image/x-icon" href="{{url('public/app-assets/images/ico/ico.jpg')}}">

      <style>
          #page-container {
              position: relative;
              min-height: 100vh;
          }

          #content-wrap {
              padding-bottom: 2.5rem;    /* Footer height */
          }

          #footer {
              position: absolute;
              bottom: 0;
              width: 100%;
              height: 2.5rem;            /* Footer height */
          }


      </style>

    <link rel="shortcut icon" type="image/png" href="{{url('public/app-assets/images/ico/ico.jpg')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/bootstrap.css')}}">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/fonts/icomoon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/fonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/extensions/pace.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/colors.css')}}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/core/colors/palette-gradient.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/css/style.css')}}">


      <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
      <style>
          body {
              font-family: 'Cairo';font-size: 14px;
          }
      </style>
    <!-- END Custom CSS-->
@else 


<html lang="en" data-textdirection="rtl" class="loading">
  <head>
      @php
          $setting =   \App\Setting::orderBy('id','desc')->first()

      @endphp
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{$setting->system_name_ar}}</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('public/app-assets/images/ico/apple-icon-60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('public/app-assets/images/ico/apple-icon-76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('public/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('public/app-assets/images/ico/apple-icon-152.png')}}">
{{--    <link rel="shortcut icon" type="image/x-icon" href="{{url('public/app-assets/images/ico/ico.jpg')}}">--}}
{{--    <link rel="shortcut icon" type="image/png" href="{{url('public/app-assets/images/ico/ico.jpg')}}">--}}
      <link rel="shortcut icon" type="image/png" href="{{Storage::url($setting->logo)}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">  
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css-rtl/bootstrap.css')}}">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/fonts/icomoon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/fonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/extensions/pace.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css-rtl/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css-rtl/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css-rtl/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css-rtl/custom-rtl.css')}}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css-rtl/core/menu/menu-types/vertical-overlay-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/css/style-rtl.css')}}">
    <!-- END Custom CSS-->
    <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
<style>
body {
    font-family: 'Cairo';font-size: 14px;
}

</style>
 

@endif
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
  <div id="page-container">
      <div id="content-wrap">
