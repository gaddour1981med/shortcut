<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

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
          
          /** init access log data from request and db */
          $log_data=["url"=>$shortcut->url,
                     "IP"=>$request->ip()??'unknown',                     
                     "User Agent"=>$request->header('User-Agent')??"unknown"];

          /** add user id if exist */
          if(Auth::check()){
            $log_data=array_merge(array("userid" =>Auth::id()),$log_data);
          }

          /** add country info if available */
          $locationInfo = Location::get($request->ip());
          if($locationInfo){
            $log_data["country"]= $locationInfo->countryName;
          }
          
          /** add access log */
          Log::channel('accesslinks')->info("", $log_data);

          /** redirect to URL */
          return redirect($shortcut->url);

        }   
     
        /** return error view */
        return view("links.expired");
    }
}
