<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Traits\RespuestaApi;
use Closure;
use Illuminate\Support\Facades\Auth;

class SetAcceptJsonHeader
{
    use RespuestaApi;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
