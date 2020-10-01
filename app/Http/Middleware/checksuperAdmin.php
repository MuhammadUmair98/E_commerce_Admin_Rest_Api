<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checksuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('admin')->check()){
        if(Auth::guard('admin')->user()->email=="MuhammadUmaira98@gmail.com"){
       
              return $next($request);
        }
    }
    abort(403, 'Unauthorized action.');
    }
}
