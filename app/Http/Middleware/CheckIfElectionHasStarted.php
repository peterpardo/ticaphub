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

        // ADMIN
        if(
            $user->hasRole('admin') && 
            !$ticap->election_has_started
            ) {
            return redirect()->route('set-positions');
        } else if(
            $user->hasRole('admin') && 
            $ticap->election_has_started && 
            !$ticap->election_finished && 
            !$ticap->has_new_election
            ) {
            return redirect()->route('election');
        } else if(
            $user->hasRole('admin') && 
            $ticap->election_has_started && 
            !$ticap->election_finished && 
            $ticap->has_new_election
            ) {
            return redirect()->route('new-election');
        }

        // STUDENT
        if (
            $user->hasRole('student') &&
            $ticap->election_has_started && 
            !$ticap->has_new_election && 
            !$user->userProgram->has_voted
            ) {
            return redirect()->route('vote');
        } else if (
            $user->hasRole('student') && 
            $ticap->election_has_started && 
            $ticap->has_new_election && 
            !$user->userProgram->has_voted
            ) {
            return redirect()->route('new-vote');
        }

        return $next($request);
    }
}
