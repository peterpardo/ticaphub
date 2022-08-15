<?php

namespace App\Http\Middleware;

use App\Models\Specialization;
use Closure;
use Illuminate\Http\Request;

class CheckIfSpecializationExists
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
        // Check if specialization exists
        if (!Specialization::where('id', $request->route('id'))->exists()) {
            return redirect()->route('project-assessment');
        }

        return $next($request);
    }
}
