<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        if(auth()->check()){
            foreach($roles as $role){
                if(auth()->user()->{$role}()){
                    return $next($request);
                }
            }
            return redirect()->route('dashboard')->with('error', 'Anda tidak mempunyai izin membuka halaman');
        }

        return redirect()->route('login');
    }
}
