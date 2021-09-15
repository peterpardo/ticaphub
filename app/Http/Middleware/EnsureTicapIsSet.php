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
        $user = User::find(1);

        if (Auth::user()->id == 1 && $user->ticap_id == null) {
            return redirect()->route('set-ticap-name');
        } 

        return $next($request);

    }
}
