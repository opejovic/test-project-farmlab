<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class MustBeFarmlabMember
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
        if (! $request->user()->isOfType(User::FARM_LAB_MEMBER, User::ADMIN)) {
            abort(403, 'No way.');
        }

        return $next($request);
    }
}
