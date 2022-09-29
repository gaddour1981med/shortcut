<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureMaxLinks
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
        if(Link::where("user_id",Auth::id())->count()
                       >=config('links.max_user_links')){

                 return redirect()->route('home')->with('info', __('Max Allowed Links',
                                     ['n' => config('links.max_user_links')]));

        }  
        return $next($request);    
    }
}
