<?php

namespace App\Http\Middleware;

use App\Organization;
use App\Calendar;

use Closure;
use Sentinel;
use URL;
use View;
use Session;

class AuthenticateSentinel
{
 
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle ($request, Closure $next, $guard = null)
    {
        $user_login = Sentinel::check();
        
        if (!$user_login) {
           return redirect()->route("dashboard_login")->with('_redirect', URL::current());
        } else {
        	View::share('user_login', $user_login);
        }
        
        return $next($request);
    }

}
