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

        if($request->user()->cannot('admin.login')){
            abort(403);
        }
        $routeName = $request->route()->getName();
        if(!$request->session()->get('admin.login') &&  $routeName !== 'admin.account.login'){
            return redirect(route('admin.account.login'));
        }

        /*超级管理员不受权限策略影响*/
        if(in_array($routeName,['admin.account.login','admin.account.logout'])){
            return $next($request);
        }
        /*加入权限检测逻辑*/
        if(!str_contains($routeName,['admin.setting'])){
            $routeName = substr($routeName,0,strripos($routeName,".")) . '.index';
        }
        if(!$request->user()->hasPermission($routeName)){
            abort(403);
        }
        return $next($request);
    }
}
