<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Event;
use App\Models\File;
use App\Models\TaskList;
use App\Models\Task;
use App\Models\User;
use App\Models\UserSpecialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index(){
        $title = 'Manage Events';

        $scripts = [
            asset('js/events/addEvent.js'),
        ];

        return view('events.event', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }

    public function fetchEvents(){
        $events = Event::all();

        return response()->json([
            'events' =>  $events,
        ]);
    }

    public function addEvent(Request $request) {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            // INSERT EVENT
            Event::create([
                'name' => $request->event_name,
                'ticap_id' => Auth::user()->ticap_id
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Event Added SuccessFully',
            ]);
        }
    }

    public function deleteEvent(Request $request){
        $validator = Validator::make($request->all(), [
            'event_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            // DELETE EVENT
            Event::find($request->event_id)->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Event Deleted SuccessFully',
            ]);
        }
    }

    public function viewEvent($id) {
        $title = 'Manage Events';

        $event = Event::find($id);
        
        $scripts = [
            asset('js/events/addList.js'),
        ];

        return view('events.list', [
            'title' => $title,
            'event' => $event,
            'scripts' => $scripts,
        ]);
    }

    public function addList(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            // INSERT LIST
            $event = Event::find($id);

            $event->lists()->create([
                'title' => $request->title,
                'user_id' => Auth::user()->id,
                'event_id' => $event->id
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'List Added SuccessFully',
            ]);
        }
    }

    public function fetchLists($id){
        $lists = TaskList::with(['user.school', 'user.roles', 'event', 'user.userSpecialization.specialization'])->where('event_id', $id)->get();

        return response()->json([
            'lists' =>  $lists,
        ]);
    }

    public function deleteList(Request $request){
        $validator = Validator::make($request->all(), [
            'list_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            // DELETE LIST
            TaskList::find($request->list_id)->delete();

            return response()->json([
                'status' => 200,
                'message' => 'List Deleted SuccessFully',
            ]);
        }
    }

    public function viewList($id, $list){
        $list = TaskList::find($list);
        $event = Event::find($id);
        $title = "Manage Events";
        
        $users = User::role(['officer', 'chairman'])->get();
       
        $scripts = [
            asset('js/events/addTask.js'),
        ];

        return view('events.tasks', [
            'list' => $list,
            'title' => $title,
            'event' => $event,
            'scripts' => $scripts,
            'users' => $users,
        ]);
    }

    public function searchMember(Request $request) {
        // EXPECTS AJAX
        if($request->ajax()){
            if($request->member == '') {
                return response('');
            }

            $member = $request->member;
        
            $data = User::role(['officer', 'chairman'])
                    ->where(function ($query)  use ($member){
                        $query->where('first_name', 'like', '%'.$member.'%')
                            ->orWhere('middle_name', 'like', '%'.$member.'%')
                            ->orWhere('last_name', 'like', '%'.$member.'%')
                            ->orWhere('student_number', 'like', '%'.$member.'%'); 
                    })
                    ->get();

            $output = '';
        
            if($data){
                foreach($data as $user){
                    $output .=  '<div class="rounded px-2 py-1 hover:bg-gray-100 cursor-pointer" data-id="' . $user->id . '"><span class="font-semibold">' . $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . '</span> | ' . $user->school->name . ' | '. $user->userSpecialization->specialization->name . '</div>';
                }
            } else {
                $output .= '<div class="rounded border-2-black px-2 py-2 hover:bg-gray-200 cursor-pointer">No Results</div>';
            }
    
            return response($output);
        }
    }   

    public function addTask(Request $request, $event, $listId) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            // ADD TASK
            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'list_id' => $listId,
                'user_id' => Auth::user()->id
            ]);

            // CHECK IF MEMBERS EXIST
            if($request->members){
                foreach($request->members as $member){
                    $task->users()->attach($member);
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Task Added Successfully',
            ]);
        }
    }

    public function fetchTasks($id){
        $tasks  = Task::with(['users', 'taskCreator'])->where('list_id', $id)->get();

        return response()->json([
            'tasks' =>  $tasks,
        ]);     
    }

    public function deleteTask(Request $request){
        Task::find($request->task_id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Task Deleted Successfully',
        ]);
    }

    public function viewTask($eventId, $listId, $taskId){
        $event = Event::find($eventId);
        $list = TaskList::find($listId);
        $lists = TaskList::all();
        $task = Task::find($taskId);
        $title = "Manage Events";
       
        $scripts = [
            asset('js/events/addActivity.js'),
            asset('js/modal.js'),
        ];

        return view('events.task-details', [
            'list' => $list,
            'title' => $title,
            'event' => $event,
            'task' => $task,
            'scripts' => $scripts,
            'lists' => $lists,
        ]);
    }

    public function addActivity(Request $request, $eventId, $listId, $taskId){
        // VALIDATED ACTIVITY REPORT
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ], [
            'description.required' => 'Activity Report is required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        } else {
            // INSERT ACTIVITY
            $activity = Activity::create([
                'description' => $request->description,
                'user_id' => Auth::user()->id,
                'task_id' => $taskId,
            ]);

            // CHECK IF USER UPLOADED A FILE
            if($request->file('files')){
                foreach($request->file('files') as $file){
                    $path = 'event-files/';
                    $f = $file;
                    $file_name = time().'_'.$f->getClientOriginalName();
                    
                    // STORE EVENT FILES 
                    $f->storeAs($path, $file_name, 'public');
                    File::create([
                        'name' => $file_name,
                        'task_id' => $taskId,
                        'event_id' => $eventId,
                        'activity_id' => $activity->id,
                    ]);
                }
            }
           

            return response()->json([
                'status' => 200,
                'message' => 'Activity Report added'
            ]);
        }
    }

    public function fetchActivities($taskId){
        $activities  = Activity::with(['user', 'files'])->where('task_id', $taskId)->latest()->get();

        return response()->json([
            'activities' =>  $activities,
        ]);    
    }

    public function downloadEventFile($fileName) {
        return Storage::download('public/event-files/'.$fileName);
    }

    public function fetchFiles($taskId) {
        $files = File::where('task_id', $taskId)->get();

        return response()->json([
            'files' =>  $files,
        ]); 
    }

    public function moveTask(Request $request, $eventId, $listId, $taskId) {
        $validator = Validator::make($request->all(), [
            'list' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            // UPDATE LIST ID OF TASK
            Task::where('id', $taskId)->update(['list_id' => $request->list]);

            $url = url('events/'.$eventId);
        
            return response()->json([
                'status' => 200,
                'url' => $url,
            ]);
        }
    }
}
