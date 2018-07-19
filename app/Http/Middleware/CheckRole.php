<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use URL;
use View;
use Session;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        $user_login = Sentinel::check();
        
        if(in_array($user_login->roles->first()->name, $role)){
            
           View::share('user_login', $user_login);
         }
        else {
            
            return redirect()->route("dashboard_home")->with('_redirect', URL::current());
        }
        return $next($request);
    }
}
