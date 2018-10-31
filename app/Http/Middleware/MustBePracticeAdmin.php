<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class MustBePracticeAdmin
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
        if (! $request->user()->isOfType(User::PRACTICE_ADMIN, User::ADMIN)) {
            abort(403, 'No way.');
        }

        return $next($request);
    }
}
