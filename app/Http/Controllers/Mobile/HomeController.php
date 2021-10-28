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

    public function showUser($id) {
        $user = User::find($id);
        if($user->hasRole('student')) {
            $student = User::where('id', $user->id)->with(['userSpecialization.specialization', 'userGroup.group'])->get();
            return $student;
        } else {
            return $user;
        }
    }

    public function updateUser(Request $request, $id) {
        $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'id_number' => 'numeric',
        ]);
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->save();
        if($user->hasRole('student')) {
            $user->userSpecialization->id_number = $request->id_number;
            $user->userSpecialization->save();
        }
        return response([
            'message' => 'Profile updated'
        ]);
    }
}
