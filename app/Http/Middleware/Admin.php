<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;

class Admin extends Middleware
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

        
        if(!Auth::guard('admin')->check()){
           
            return redirect()->route('login');
        }  

      if(Auth::guard('admin')->user()->email=="MuhammadUmaira98@gmail.com")    {
      return redirect()->route('superhome');

      } 

        return $next($request);
        
        }
    
}
