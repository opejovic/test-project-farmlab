<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class MustBePracticeMember
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
        abort_unless($request->user()->isOfType(User::VET, User::PRACTICE_ADMIN), 403);

        return $next($request);
    }
}
