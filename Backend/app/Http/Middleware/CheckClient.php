<?php

namespace App\Http\Middleware;

use Closure;

class CheckClient
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
        if ($request->type == 1) {
            return $next($request);


        }
        return 'zdzd';
    }
}
