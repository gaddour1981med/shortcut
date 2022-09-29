<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SetLocale
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
        $locale=in_array($request->segment(1),config('app.available_locales'))
                   ?$request->segment(1)
                   :config('app.fallback_locale');
                  
        
        app()->setLocale($locale);

        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
