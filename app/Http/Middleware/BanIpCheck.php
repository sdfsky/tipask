<?php

namespace App\Http\Middleware;

use App\Models\BanIp;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BanIpCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ip = $request->getClientIp();
        $ips = Cache::rememberForever('ip_blacklist', function () {
            if (!file_exists(storage_path('installed'))) {
                return [];
            }
            return BanIp::all()->pluck('ip')->toArray();
        });

        if (Auth::check() && !Auth::user()->isSuperAdmin()) {
            if (in_array($ip, $ips)) {
                abort('403');
                return false;
            }
        }

        return $next($request);
    }
}
