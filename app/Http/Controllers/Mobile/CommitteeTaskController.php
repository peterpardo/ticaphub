<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\CommitteeTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommitteeTaskController extends Controller
{
    public function index($commId) {
        $committee = Committee::where('id', $commId)->with(['user', 'committeeMembers.user', 'tasks'])->get();

        return $committee;
    }

    public function getMembers($commId) {
        $committee = Committee::find($commId);

        return $committee->committeeMembers();
    }

    public function viewTask($commId, $taskId) {
        $task = CommitteeTask::find($taskId);

        return $task;
    }

    public function addTask(Request $request, $commId) {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        // ADD TASK
        $task = CommitteeTask::create([
            'title' => $request->title,
            'description' => $request->description,
            'committee_id' => $commId,
        ]);

        // CHECK IF MEMBERS EXIST
        if($request->members){
            foreach($request->members as $member){
                $task->users()->attach($member);
            }
        }

        return response([
            'message' => 'Task Added Successfully', 
        ]);
    }

    public function editTask(Request $request, $commId, $taskId) {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required',
        ]);

         // UPDATE TASK
         $task = CommitteeTask::find($taskId);
         $task->title = $request->title;
         $task->description = $request->description;
         $task->status = $request->status;

         // REMOVE ALL MEMBERS FROM TASK
         $task->users()->detach();

         // INSERT NEW SET OF MEMBERS TO TASK
         if($request->members) {
             $task->users()->attach($request->members);
         }

         $task->save();

         return response([
            'message' => 'Task succesfully updated',
         ]);
    }

    public function deleteTask($commId, $taskId)  {
        CommitteeTask::find($taskId)->delete();

        return response([
            'message' => 'Task successfully deleted.',
        ]);
    }
}
