
@extends('welcome')
@section('content')

<br> 
<div class="app-content content container-fluid">
                  <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a> 
                </li>
                <li class="breadcrumb-item"> <a href="{{url('bonuses')}}">{{trans('admin.bounuse')}} </a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.Add')}} 
                </li>
              </ol>
            </div> 
       </div>  

<div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
               
                
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
            <div class="card-header">
              <h3 class="card-title">{{trans('admin.createtitle')}} </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
            {{ Form::open(array('url' =>url('bonuses'))) }}
            {!! csrf_field() !!}
              

            <div class="form-group"> 
            <strong>{{trans('admin.bonName')}}</strong>
            {{ Form::text('name',old('name'),["class"=>"form-control" ]) }}
            </div> 

            <div class="form-group"> 
            <strong>{{trans('admin.overtime')}}</strong> 
             {{ Form::number('overtime',old('overtime'),["class"=>"form-control" , 'step' => 'any' ,'max'=>'10'  ]) }}  
            </div> 
            
            <div class="form-group"> 
            <strong>{{trans('admin.late')}}</strong> 
             {{ Form::number('late',old('late'),["class"=>"form-control" , 'step' => 'any','max'=>'10']   ) }}  
            </div> 
            
            <div class="form-group"> 
            <strong>{{trans('admin.early')}}</strong> 
             {{ Form::number('early',old('early'),["class"=>"form-control" , 'step' => 'any' ,'max'=>'10']  ) }}  
            </div> 
            

            <div class="form-group"> 
            <strong>{{trans('admin.notsign')}}</strong> 
             {{ Form::number('notsign',old('notsign'),["class"=>"form-control", 'step' => 'any' ,'max'=>'10']  ) }}  
            </div> 


            <div class="form-group"> 
            <strong>{{trans('admin.absence')}}</strong> 
             {{ Form::number('absence',old('absence'),["class"=>"form-control", 'step' => 'any','max'=>'10' ]) }}  
            </div> 

            

           <div> {{ Form::submit( trans('admin.Add') ,['class'=>'btn btn-info']) }} </div>
            {{ Form::close() }} 
            </div> 

            


@endsection