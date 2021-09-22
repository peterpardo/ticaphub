<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Closure;
use Illuminate\Http\Request;

class EnsureEventExists
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
        if(Event::where('id', $request->route('eventId'))->exists()){
            return $next($request);
        }
        
        return redirect()->route('events')->with([
            'status' => 'red',
            'message' => 'Event Already Been Deleted by the Admin'
        ]);
    }
}
