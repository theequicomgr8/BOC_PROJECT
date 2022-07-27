<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class BocuserAuthenticate extends Middleware
{

    protected function authenticate($request, array $guards)
    {
 
        //dd($this->auth->guard('bocuser')->check());

        if ($this->auth->guard('bocuser')->check()) {
            return $this->auth->shouldUse('bocuser');
        }

        $this->unauthenticated($request, $guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
