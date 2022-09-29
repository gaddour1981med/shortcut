@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if(Session::has('status'))
              <x-alert class="alert-success"  :message="Session::get('status')"></x-alert> 
            @endif
          
            @if ($errors->db->any())
            <div class="alert alert-danger">
               <ul>
                @foreach ($errors->db->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
               </ul>
            </div>
            @endif

            <div class="card">   
                <div class="card-header"> 
                    {{__("Add")}}    
                 </div>             
                <div class="card-body">
                   
                    <form method="POST" action="{{ route('links.add.save') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="domain" class="col-md-4 col-form-label text-md-end">{{ __('URL to convert') }}</label>
                               <div class="col-md-6">                                   
                               <textarea rows="4"  id="url" name="url" class="form-control @error('url') is-invalid @enderror" name="url" required  autofocus>{{ old('url') }}</textarea>
                                    @error('url')
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror                                    
                               </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Convert') }}
                                </button>
                            </div>
                        </div>

                    </form> 
          
                </div>
            </div>          
        </div>
    </div>
</div>
@endsection
