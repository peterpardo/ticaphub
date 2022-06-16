<?php

namespace App\Http\Middleware;

use App\Models\Ticap;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfInvitationHasBeenSet
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
        $ticap = Ticap::find(Auth::user()->ticap_id);

        // Check if ticap settings has not yet been set
        if (!$ticap->invitation_is_set) {
            $request->session()->flash('status', 'red');
            $request->session()->flash('message', 'Set schools that are involved in this TICAP');
            return redirect()->route('users');
        }

        return $next($request);
    }
}
