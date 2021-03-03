<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
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
        $flag = 0;
        if(Auth::check())
        {
          $user=Auth::user();
          if($user->role_id == 1)
            $flag = 1;
        }

        return $flag ? $next($request) : redirect('/login');
    }
}
