<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Http\Request;

class EnsureMaxDBLinks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        
        $count = Link::count();
        if($count>=config('links.max_db_links')){
          Link::orderBy('created_at', 'desc')
                ->take($count)
                ->skip(config('links.max_db_links')-1)
                ->get()
                ->each(function($row){ 
                    $row->delete();
                });       
        }  
        return $next($request); 
    }  
}
