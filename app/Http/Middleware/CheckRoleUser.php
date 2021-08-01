<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
                if ( auth()->user()->status == 1) {
                return $next($request);
            }
            return redirect(route('index'))->with('failed','شما بلاک شده اید');
        }
        return redirect(route('index'));
    }
}
