<?php

namespace App\Http\Middleware;

use App\Models\OperationLog;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOperationLog
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
        $user_id = 0;
        if (Auth::check()){
            $user_id = Auth::id();
        }
        if ($request->method() != 'GET'){
            $input = $request->all();
            $operationLog = new OperationLog();
            $operationLog->user_id = $user_id;
            $operationLog->method = $request->method();
            $operationLog->action = $request->path();
            $operationLog->data = json_encode($input);
            $operationLog->ip = $request->ip();
            $operationLog->created_at = date('Y-m-d H:i:s',time());
            $operationLog->save();
        }
        return $next($request);
    }
}
