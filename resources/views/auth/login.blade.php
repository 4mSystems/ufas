@extends('layouts.master-without-nav')


@section('content')
 
    <!-- Begin page -->
    @php
        $setting =   \App\Setting::orderBy('id','desc')->first()

    @endphp

    <style>
    .logose{
        background-color:rgb(45,45,45);

    }


    </style>
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="card">
            <div class="card-body">
                  <div class="logose">
                <h3 class="text-center m-0"  >
                    <a href="index" class="logo logo-admin"><img src="{{ Storage::url($setting->logo) }}"
                                                                 style="width:200px;height:40px;" alt="logo"></a>
                </h3>
                 </div>
                <div class="p-3"> 
                    <p class="text-muted text-center">Sign in {{$setting->system_name_en}}</p>

                    <form  method="POST" action="{{ route('login') }}" class="form-horizontal m-t-30" >
                        @csrf
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Enter your mobile">
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">Remember me</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">{{ __('Login') }}</button>
                            </div>
                        </div>


                    </form>
                </div>

            </div>
        </div>


    </div>
@endsection


