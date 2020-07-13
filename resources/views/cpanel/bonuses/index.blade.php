
@extends('welcome')
@section('content')
 
<br> 
<div class="app-content content container-fluid">
                  <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="breadcrumb-item"> {{trans('admin.bounuse')}}  
                </li>
                
              </ol>
            </div> 
       </div>

                            <!-- /.card-header -->
              
                
        <div class="app-content content container-fluid">
                         <div class="content-wrapper">
                        <div class="content-header row">
                        </div>
                  <div class="content-body" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '><!-- stats -->
                            <div class="row">
    
                                      <div class="card">
                                                  <div class="card-body">
                                            <div class="card-body collapse in">
              
    <div style=' padding-top: 10px;
                            padding-right: 15px;
                             ' >
    
    <h3 class="card-title">{{trans('admin.bounuse')}} </h3>
    </div>


                <div style=' padding-top: 10px;
                            padding-right: 15px;
                             '>
                <a href="{{url('bonuses/create')}}  " class="btn btn-info btn-bg">{{trans('admin.createtitle')}} </a>
                </div >
                <br>
                
            
                <div class="table-responsive" style=' padding-top: 10px;
                            padding-right: 15px;
                             padding-left: 20px;
                             '>
                    <table class="table">
                        <thead class="bg-info">
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.bonName')}}</th>
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($bounses as $bounses)
                            <tr>
                                <th scope="row">{{$bounses->id}}</th>
                                <td>{{$bounses->name}}</td>
                                 
                               
                      <th> <a class='btn btn-raised btn-success btn-sml' href=" {{url('bonuses/'.$bounses->id.'/edit')}}" ><i class="icon-edit"></i></a> 
                      

                      <form method="get" id='delete-form-{{ $bounses->id }}' action="{{url('bonuses/'.$bounses->id.'/delete')}}"  
                      style='display: none;'>
                      {{csrf_field()}}
                      <!-- {{method_field('delete')}}   -->
                      </form>
                      <button onclick="if(confirm('are you sure to delete this record?'))
                      {
                          event.preventDefault();
                          document.getElementById('delete-form-{{ $bounses->id }}').submit();
                      }else {
                            event.preventDefault(); 
                      }
                      
                      "
                  class='btn btn-raised btn-danger btn-sml' href=" "><i class="icon-android-delete" aria-hidden='true'>
                    </i > 
                  
                    
                    </button>
                    </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

</div>
</div>
</div>
 
 
 

@endsection
