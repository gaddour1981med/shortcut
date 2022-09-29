@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if(Session::has('status'))
            <x-alert class="alert-success"  :message="Session::get('status')"></x-alert> 
            @endif  
            
            @if(Session::has('info'))
            <x-alert class="alert-secondary"  :message="Session::get('info')"></x-alert> 
            @endif
           
            @if(Session::has('error'))
            <x-alert class="alert-danger"  :message="Session::get('error')"></x-alert> 
            @endif
            
            <div class="card">
              
                <div class="card-body">
                   

                    @if (count($links) > 0)   
                    
                    <div class=""  >
          
                        <div class="table-title">
                            <div class="row col-12">
                                <div class="col-8"><h2>{{__("My Links")}}</h2></div>
                                <div class="col-4 d-md-flex justify-content-end">    
                                    <div class="d-grid d-md-block flex-wrap">
                                     <a href="{{route('links.add.form')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Add')}}</a>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-border ">
                            <thead>                   
                                <tr>                                    
                                    <th>{{ __('Url')}}</th>                  
                                    <th>{{ __('ShortCut')}}</th>   
                                    <th>{{ __('Date')}}</th>                                
                                    <th>{{ __('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($links as $link)
                                <tr>
                                    <td>{{ $link->url }}</td>
                                    <td><a href="{{ route("shortcut",$link->shortcut) }}" target="_blank"> {{ config('app.url') ."/". $link->shortcut }}</a></td>                                    
                                    <td>{{ $link->created_at }}</td>  
                                    <td><a href="#">{{ __("Delete")}}</a></td>  
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
