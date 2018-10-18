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
        $user = $request->user();
        if ($user && $user->type == User::ADMIN) {
            return $next($request);
        } 
        abort(403, 'No way.');
    }
}
