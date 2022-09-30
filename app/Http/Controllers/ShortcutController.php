<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class ShortcutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $shortcut=Link::where("shortcut","=",$request->shortcut)->first();
        
        if($shortcut){
          return redirect($shortcut->url);
        }   
     
        return view("links.expired");
    }
}
