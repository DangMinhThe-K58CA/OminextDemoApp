<?php

namespace App\Http\Middleware;

use Closure;

use Redirect;

use Auth;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() == 1) {
            if (Auth::user()->admin == 2 || Auth::user()->admin == 1) {
                return $next($request);
            }
            else {
                return Redirect::to('/adminLogin');
            }
        }
        else {
            return Redirect::to('/adminLogin');
        }
        
        // if ($role != 'admin') {
        //     return $next($request);
        // }
        // else {
        //     return Redirect::to('/show');
        // }
    }
}
