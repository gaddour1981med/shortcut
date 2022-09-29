<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Rules\ValidUrl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LinksController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }



    public function form(Request $request){
      return view("links.add");
    }



    public function save(Request $request){

        $request->validate([
         'url' => ['bail','required','string', 'max:255',new ValidURL()]
        ]);  
            
                    
        try {    
                
                      
            $link=new Link();
            $link->url=$request->all()["url"];
            $link->shortcut=Str::random(6);
            $link->user_id=Auth::id();
            $link->created_at=strtotime(now());
            $link->save();

             
        } catch (\Exception $e) {
                
               return Redirect::route('links.add.form')
                           ->withErrors( $e->getMessage(),"db" )
                           ->withInput();
        }            
            
        return  Redirect::route('home')
                        ->with('status', __('Link Converted successfully'));
    }

}
