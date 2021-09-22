<?php

namespace App\Http\Middleware;

use App\Models\TaskList;
use Closure;
use Illuminate\Http\Request;

class EnsureListExists
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
        if(TaskList::where('id', $request->route('listId'))->exists()){
            return $next($request);
        }
        
        return redirect()->route('events')->with([
            'status' => 'red',
            'message' => 'List Already Been Deleted by an Admin/Officer'
        ]);
    }
}
