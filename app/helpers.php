<?php
/**
 * File ${NAME}
 * ${CARET}
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    ${NAMESPACE}
 * @subpackage ${CARET}
 * @author     Sujit Baniya <sujit@kvsocial.com>
 * @copyright  2018 Kyvio.com. All rights reserved.
 */

use Illuminate\Support\Facades\Cache;
use Modules\Site\Entities\Site;

if( !function_exists('site'))
{
    function site($key = null)
    {

        $host   = request()->getHttpHost();
        $subDomains = getSubDomains($host);
        if(in_array($subDomains, ['', 'main', 'www']))
        {
            $subDomains = 'main';
        }
        $site = Cache::remember('site:' . $subDomains, 7 * 24* 60, function () use ($subDomains) {
            return Site::where('slug', $subDomains)->first();
        });
        return $site;
    }
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

function getSubDomains($domain)
{
    $subdomains = $domain;
    $domain = getDomain($subdomains);

    $subdomains = rtrim(strstr($subdomains, $domain, true), '.');

    return $subdomains;
}
