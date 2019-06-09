<?php

namespace App\Http\Middleware;

use Closure;

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
        if(auth()->user()->role_type == 1){

            return $next($request);
        }
        else {
            return redirect('/home')->with(['notification'=>'error',
                                            'message'=>'You dont have the rights to acces' ]);
        }
    }
}
