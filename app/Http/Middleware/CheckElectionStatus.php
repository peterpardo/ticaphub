<?php

namespace App\Http\Middleware;

use App\Models\Election;
use Closure;
use Illuminate\Http\Request;

class CheckElectionStatus
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
        $election = Election::find($request->route('id'));

        // Check status of election
        if ($election->status === 'in progress') {
            return redirect()->route('election');
        } else if ($election->status === 'done') {
            return redirect()->route('officers', ['id' => $election->id]);
        }

        return $next($request);
    }
}
