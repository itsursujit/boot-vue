<?php

namespace Modules\Site\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Site\Entities\Site;
use Modules\User\Entities\User;
use Nwidart\Modules\Facades\Module;

class SiteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     * @throws \Throwable
     */
    public function handle(Request $request, Closure $next)
    {
        $site = site();
        throw_if(empty($site), new \Exception("No Website Found"));
        $request->site = $site;
        return $next($request);
    }
}
