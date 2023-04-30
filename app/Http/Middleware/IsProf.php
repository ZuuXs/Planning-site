<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsProf
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
        if ($request->user()->isProf()) {
            return $next($request);
        }
        abort(403, 'You are not Prof');
    }
}
