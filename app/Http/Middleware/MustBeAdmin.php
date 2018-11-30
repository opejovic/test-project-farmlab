<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class MustBeAdmin
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
        abort_unless($request->user()->isOfType(User::ADMIN), 403);
        
        return $next($request);
    }
}
