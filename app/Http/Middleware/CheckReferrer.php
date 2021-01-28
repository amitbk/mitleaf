<?php

namespace App\Http\Middleware;

use Closure;

class CheckReferrer
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
        // if( $request->has('ref') &&  !Auth::check() ) {
        if( $request->has('ref') ) {
          $referrer = \App\User::find( $request->ref );
          if($referrer)
            session(['ref' => ['id' => $referrer->id, 'time' => date('Y-m-d H:i:s') ] ]);

          // $ref = session()->get('ref.id');
          // session()->forget('ref');
        }

        return $next($request);
    }
}
