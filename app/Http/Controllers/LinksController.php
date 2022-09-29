<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return "ok";
    }

}
