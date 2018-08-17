<?php

namespace Modules\Site\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SiteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $host   = request()->getHttpHost();
        $domain = explode('.', $host);
        // Log::info('1) Host: ' . $host); // webdeveloper.im
        $bottom_host_name = $host;
        if (count($domain) > 2)
        {
            $bottom_host_name = $domain[count($domain) - 2] . "." . $domain[count($domain) - 1];
        }
        dd($domain);
        return $next($request);
    }
}
