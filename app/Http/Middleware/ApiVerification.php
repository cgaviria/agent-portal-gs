<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
class ApiVerification
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
        $user_login = Sentinel::check();
       if($user_login)
        echo "ok";
    else
        echo "no";
       
        return $next($request);
    }
}
