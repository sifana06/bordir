<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsAdmin
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
        if(auth()->user()){
            if(auth()->user()->isAdmin()){
                return $next($request);
            }
            return abort(401, 'Anda tidak mempunyai izin membuka halaman');
        }
        return redirect()->route('login');
    }
}
