<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class EmailVerify
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
        
        if (Auth::check() && Auth::user()->email_verified_at == null) {
            return redirect('email/verify');
        }
        return $next($request);
    }
}
