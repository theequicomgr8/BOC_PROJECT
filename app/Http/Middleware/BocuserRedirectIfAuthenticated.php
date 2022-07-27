<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BocuserRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        
            if (Auth::guard('bocuser')->check()) {
                return redirect()->route('home');
            }
            // if (Auth::guard('web')->check()) {
            //     return redirect()->route('home');
            // }

        return $next($request);
    }
}
