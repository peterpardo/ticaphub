<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckIfUserIsPanelist
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
        $user = User::find(auth()->user()->id);

        if (!$user->hasRole('panelist')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
