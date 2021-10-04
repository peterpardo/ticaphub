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
        $user = User::find(Auth::user()->id);

        if ($user->hasRole('admin') && $user->ticap_id == null) {
            session()->flash('status', 'red');
            session()->flash('message', 'Set TICaP first');
            return redirect()->route('dashboard');
        } 

        return $next($request);

    }
}
