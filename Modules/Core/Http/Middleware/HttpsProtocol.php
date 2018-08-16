<?php
/**
 * Created by IntelliJ IDEA.
 * User: spbaniya
 * Date: 8/16/18
 * Time: 5:09 PM
 */

namespace Modules\Core\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class HttpsProtocol
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->secure() && \in_array(env('APP_ENV'), ['prod', 'production'])) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
