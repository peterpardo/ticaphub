<?php

namespace App\Http\Middleware;

use App\Models\Specialization;
use App\Models\User;
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
        $user = User::find(auth()->user()->id);

        // Check if panelist and grading not yet started
        if ($user->hasRole('panelist') && $spec->status === 'not started') {
            return back()
                ->with('status', 'red')
                ->with('message', 'The grading of groups for this specialization has not yet started. Contact an event organizer for more information.');
        } else if ($user->hasAnyRole('superadmin', 'admin') && $spec->status === 'not started') {
            return redirect()
                ->route('project-assessment')
                ->with('status', 'red')
                ->with('message', 'Set first the awards and panelists');
        }

        return $next($request);
    }
}
