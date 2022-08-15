<?php

namespace App\Http\Middleware;

use App\Models\Specialization;
use Closure;
use Illuminate\Http\Request;

class CheckSpecializationStatus
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
        $spec = Specialization::find($request->route('id'));

        if ($spec->status === 'not started') {
            return back()
                ->with('status', 'red')
                ->with('message', 'The grading of groups for this specialization has not yet started. Contact an event organizer for more information.');
        }

        return $next($request);
    }
}
