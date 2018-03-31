<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckUserActivation
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
        if (!Auth::user()->activated) {
            return redirect('/users/activate');
        }

        return $next($request);
    }
}
