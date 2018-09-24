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
        if (! $request->user()->isOfType(User::VET, User::PRACTICE_ADMIN)) {
            return redirect('home');
        }

        return $next($request);
    }
}
