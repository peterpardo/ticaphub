<?php

namespace App\Http\Middleware;

use App\Models\Ticap;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckIfElectionHasStarted
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
        // USER MODEL
        $user = User::find(Auth::user()->id);

        // TICAP MODEL
        $ticap = Ticap::find($user->ticap_id)->first();

        if($user->hasRole('admin') && !$ticap->election_has_started) {
            return redirect()->route('set-positions');
        } else if($user->hasRole('admin') && $ticap->election_has_started && !$ticap->election_finished) {
            return redirect()->route('election');
        }else if ($user->hasRole('student') && $ticap->election_has_started && !$user->userProgram->has_voted){
            return redirect()->route('voter-panel');
        }

        return $next($request);
    }
}
