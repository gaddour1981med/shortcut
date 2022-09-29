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



    public function redirect(Request $request){
        $shortcut=Link::where("shortcut","=",$request->shortcut)
                     ->first();
        if($shortcut){
            return redirect($shortcut->url);
        }   
                  
        return view("links.expired");
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



    public function delete(Request $request){ 
            $id=isset($request->link_id)?intval($request->link_id):0;            
            if($id>0 && Link::where('id',$id)
                    ->where("user_id",Auth::id())
                    ->delete()>0){

               return  Redirect::route('home')
                    ->with('status', __('Link Converted successfully'));         
            }else{

               return  Redirect::route('home');
            }  
    }

}
