<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        $user = User::where('id', Auth::user()->id)->with(['tasks', 'roles'])->first();

        return $user;
    }

    public function showTask($taskId) {
        $task = Task::find($taskId);
        

        return response([
            'event_id' => $task->list->event->id,
        ]);
    }
}
