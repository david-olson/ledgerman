<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class IsAdmin
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
        if (!Auth::user()->userMeta()->where('meta_type_id', 1)->first() || !Auth::user()->userMeta()->where('meta_type_id', 1)->first()->contents) {
            return response(['msg' => 'You need to be an admin to do this.'], 401);
        }

        return $next($request);
    }
}
