<?php

namespace App\Http\Middleware;

use App\Models\Ticap;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfTicapIsSet
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
        $ticap = Ticap::find($user->ticap_id);

        // Check if user is an admin and ticap settings is not yet set
        if ($user->hasRole('admin') && $ticap->invitation_is_set) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
