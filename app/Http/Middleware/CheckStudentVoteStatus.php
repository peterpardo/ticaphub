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
        $election = Election::find($request->route('id'));

        // Check user if student and has not yet voted
        if ($user->hasRole('student') && !$user->userElection->has_voted) {
            return redirect('officers/elections/' . $election->id . '/vote');
        }

        // Check user if student and has voted
        if ($user->hasRole('student') && $user->userElection->has_voted) {
            return redirect('officers/elections/' . $election->id);
        }

        return $next($request);
    }
}
