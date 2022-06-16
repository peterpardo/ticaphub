<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EnsureTicapIsSet
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
        // Get current user (must be admin)
        $user = User::find(Auth::user()->id);

        // check if user is admin and ticap is null or not set
        if ($user->hasRole('admin') && is_null($user->ticap_id)) {
            $request->session()->flash('status', 'red');
            $request->session()->flash('message', 'Set TICaP first');
            return redirect()->route('dashboard');
        }

        return $next($request);

    }
}
