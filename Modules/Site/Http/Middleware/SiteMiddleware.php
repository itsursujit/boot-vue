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
        $subDomains = $this->getSubdomains($host);
        return $next($request);
    }



    function getDomain($domain)
    {
        if(preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $domain, $matches))
        {
            return $matches['domain'];
        } else {
            return $domain;
        }
    }

    function getSubdomains($domain)
    {
        $subdomains = $domain;
        $domain = $this->getDomain($subdomains);

        $subdomains = rtrim(strstr($subdomains, $domain, true), '.');

        return $subdomains;
    }
}
