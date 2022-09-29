@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($links) > 0)   
                    
                    <div class=""  >
          
                        <div class="table-title">
                            <div class="row col-12">
                                <div class="col-8"><h2>{{__("txt2")}}</h2></div>
                                <div class="col-4 d-md-flex justify-content-end">    
                                    <div class="d-grid d-md-block flex-wrap">
                                     <a href="{{route('admin.home.add.form')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('txt7')}}</a>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-border ">
                            <thead>                   
                                <tr>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('txt9')}}</th>                  
                                    <th>{{ __('txt11')}}</th>                                   
                                    <th>{{ __('txt12')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks  as $task)
                                <tr>
                                    <td></td>
                                    <td></td>                                    
                                    <td></td>  
                                    <td></td>  
                                </tr>                    
                                @endforeach    
                            </tbody>
                        </table>
                  
                    </div>              


                    @else
      
                    <h5 class="card-title">{{__('No link added')}}</h5>
                    <p  class="card-text"> {{__('Click Button To Add New Link')}} </p>                    
                                       
                    <a href="{{route("links.add.form")}}" class="btn btn-primary">{{__('Add')}}</a>
                    
                    @endif           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
