<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsAdmin
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
        $user = User::find(Auth::user()->id);

        if($user->hasAnyRole(['superadmin', 'admin']) || $user->hasPermissionTo('access user accounts') || $user->hasPermissionTo('access project assessment')) {
            return $next($request);
        }

        return redirect()->route('dashboard');
    }
}
