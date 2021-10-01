<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use App\Models\CommitteeTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommitteeController extends Controller
{
    public function index($commId) {
        $committee = Committee::find($commId);
        $title = $committee->name . " Committee";
        $scripts = [
            asset('/js/committees/tasks.js')
        ];
        return view('committee.index', [
            'title' => $title,
            'committee' => $committee,
            'scripts' => $scripts,
        ]);
    }
    public function addTaskForm($commId) {
        $committee = Committee::find($commId);
        $title = $committee->name . " Committee";
        $scripts = [
            asset('/js/committees/committeeHead.js')
        ];
        return view('committee.add-task', [
            'title' => $title,
            'scripts' => $scripts,
            'committee' => $committee,
        ]);
    }
    public function addTask(Request $request, $commId) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
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
            $url = url('committee/'.$commId);
            return response()->json([
                'status' => 200,
                'message' => 'Task Added Successfully',
                'url' => $url
            ]);
        }
    }
    public function deleteTask(Request $request, $commId){
        CommitteeTask::where('id', $request->task_id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Task Deleted Successfully',
        ]);
    }
    public function addCommitteeMember($commId) {
        $committee = Committee::find($commId);
        $title = $committee->name . " Committee";
        $scripts = [
            asset('/js/committees/committeeHead.js')
        ];
        return view('committee.add-member', [
            'title' => $title,
            'scripts' => $scripts,
            'committee' => $committee,
        ]);
    }
    public function searchCommittee(Request $request) {
        //  EXPECTS AJAX
         if($request->ajax()){
            if($request->member == '') {
                return response('');
            }
            $member = trim($request->member);
            $data = User::whereHas('committeeMember', function($q) use ($request){
                $q->where('committee_id', $request->committee);
            })
            ->search($member)
            ->get();
            $output = '';
            if($data){
                foreach($data as $user){
                    $output .=  '<div class="rounded px-2 py-1 hover:bg-gray-100 border cursor-pointer" data-id="' . $user->id . '">
                                    <span class="font-semibold">' . $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . '</span>' . 
                                '</div>';
                }
            } else {
                $output .= '<div class="rounded border-2-black px-2 py-2 hover:bg-gray-200 cursor-pointer">No Results</div>';
            }
            return response($output);
        }
    }
    public function editTaskForm($commId, $taskId) {
        $committee = Committee::find($commId);
        $task = CommitteeTask::find($taskId);
        $title = $committee->name . " Committee";
        $scripts = [
            asset('/js/committees/updateTask.js')
        ];
        return view('committee.edit-task', [
            'title' => $title,
            'scripts' => $scripts,
            'committee' => $committee,
            'task' => $task,
        ]);
    }
    public function editTask(Request $request, $commId, $taskId) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            // UPDATE TASK
            $task = CommitteeTask::find($taskId);
            $task->title = $request->title;
            $task->description = $request->description;
            $task->status = $request->status;
            // REMOVE ALL MEMBERS FROM TASK
            $task->users()->detach();
            // INSERT NEW SET OF MEMBERS TO TASK
            $task->users()->attach($request->members);
            $task->save();
            $url = url('committee/'.$commId);
            return response()->json([
                'status' => 200,
                'message' => 'Task succesfully updated',
                'url' => $url,
            ]);
        }
    }
    public function fetchCommittee($taskId) {
        $members = CommitteeTask::find($taskId)->users()->get();
        return response()->json([
            'members' => $members
        ]);
    }
    public function viewTask($commId, $taskId) {
        $committee = Committee::find($commId);
        $task = CommitteeTask::find($taskId);
        $title = $committee->name . " Committee";
        return view('committee.view-task', [
            'title' => $title,
            'committee' => $committee,
            'task' => $task,
        ]);
    }
}
