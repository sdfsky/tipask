<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthenticate
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

        if(!$request->user()->is('admin')){
            abort(403);
        }

        if(!$request->session()->get('admin.login') && $request->route()->getName() !== 'admin.account.login'){
            return redirect(route('admin.account.login'));
        }
        return $next($request);
    }
}
