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

      //  echo $request->route()->getName();

        if(!$request->user()->can('admin.account.login')){
            abort(404);
        }

        if(!$request->session()->get('admin.login')){
            return redirect(route('admin.account.login'));
        }
        return $next($request);
    }
}
