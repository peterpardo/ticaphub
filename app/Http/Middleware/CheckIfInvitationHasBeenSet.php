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
        $user = User::find(Auth::user()->id);

        $ticap = Ticap::find($user->ticap_id);

        if($user->hasRole('admin') && !$ticap->invitation_is_set){
            return redirect()->route('set-invitation');
        }
        return $next($request);
    }
}
