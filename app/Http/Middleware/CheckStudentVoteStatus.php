<?php

namespace App\Http\Middleware;

use App\Models\Election;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckStudentVoteStatus
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

        // Check user if student and has not yet voted
        if ($user->hasRole('student') && !$user->userElection->has_voted) {
            return redirect('officers/elections/' . $user->userElection->election_id . '/vote');
        }

        // Check user if student and has voted
        if ($user->hasRole('student') && $user->userElection->has_voted) {
            return redirect('officers/elections/' . $user->userElection->election_id);
        }

        return $next($request);
    }
}
