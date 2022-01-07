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
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventController extends Controller
{
    public function index(){
        $title = 'Manage Events';
        $events = Event::all();
        $scripts = [
            asset('js/events/event.js'),
        ];
        return view('events.event', [
            'title' => $title,
            'scripts' => $scripts,
            'events' => $events,
        ]);
    }

    public function downloadCode($eventId) {
        $url = url('/attendance/'. $eventId);
        QrCode::format('png')->generate($url, public_path('assets/qrcode.png'));
        return response()->download(public_path('assets/qrcode.png'));
    }

    public function addEvent(Request $request) {
        $request->validate([
            'event_name' => 'required'
        ]);
        // INSERT EVENT
        Event::create([
            'name' => $request->event_name,
            'ticap_id' => Auth::user()->ticap_id
        ]);
        return back()->with([
            'status' => 'green',
            'message' => 'Event Successfully Created'
        ]);
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
                'message' => 'Event Deleted Successfully',
            ]);
        }
    }

    public function programFlow($eventId) {
        $title = "Manage Events";
        $event = Event::find($eventId);
        return view('events.program-flow', [
            'title' => $title,
            'event' => $event,
        ]);
    }

    public function viewEvent($eventId) {
        $event = Event::find($eventId);
        $title = 'Manage Events';
        $scripts = [
            asset('js/events/list.js'),
        ];
        return view('events.list', [
            'title' => $title,
            'event' => $event,
            'scripts' => $scripts,
        ]);
    }

    public function addList(Request $request, $eventId){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:20'
        ]);

        if($validator->fails()) {
            return response([
                'errors' => $validator->errors(),
            ]);
        }

        $event = Event::find($eventId);
        $event->lists()->create([
            'title' => Str::title($request->title),
            'user_id' => Auth::user()->id,
            'event_id' => $event->id
        ]);
        return response([
            'status' => 200,
            'message' => 'List Successfully Created'
        ]);
    }


    public function deleteList(Request $request, $eventId){
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

    public function viewList($eventId, $listId){
        $event = Event::find($eventId);
        $list = TaskList::find($listId);
        $title = "Manage Events";
        $scripts = [
            asset('js/events/deleteTask.js'),
        ];
        return view('events.tasks', [
            'list' => $list,
            'title' => $title,
            'event' => $event,
            'scripts' => $scripts,
        ]);
    }

    public function searchMember(Request $request) {
        // EXPECTS AJAX
        if($request->ajax()){
            if($request->member == '') {
                return response('');
            }
            $member = trim($request->member);
            $data = User::role(['officer', 'chairman'])
                    ->where(function ($query)  use ($member){
                        $query->where('first_name', 'like', '%'.$member.'%')
                            ->orWhere('middle_name', 'like', '%'.$member.'%')
                            ->orWhere('last_name', 'like', '%'.$member.'%');
                    })
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

    public function addTaskForm($eventId, $listId) {
        $event = Event::find($eventId);
        $list = TaskList::find($listId);
        $title = "Manage Events";
        $scripts = [
            asset('js/events/addTask.js'),
        ];
        return view('events.add-task', [
            'list' => $list,
            'title' => $title,
            'event' => $event,
            'scripts' => $scripts,
        ]);
    }

    public function addTask(Request $request, $eventId, $listId) {
        // CHECK IF EVENT OR LIST STILL EXISTS
        if(!Event::where('id', $eventId)->exists()) {
            $url = url('events');
            return response()->json([
                'status' => 200,
                'message' => 'Event Already Deleted by the Admin',
                'url' => $url
            ]);
        } elseif(!TaskList::where('id', $listId)->exists() ){
            $url = url('events/'.$eventId);
            return response()->json([
                'status' => 200,
                'message' => 'List Already Been Deleted by the creator',
                'url' => $url
            ]);
        }
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
            $url = url('events/'.$eventId);
            return response()->json([
                'status' => 200,
                'message' => 'Task Added Successfully',
                'url' => $url
            ]);
        }
    }

    public function fetchTasks($id){
        $tasks  = Task::with(['users', 'taskCreator'])->where('list_id', $id)->get();

        return response()->json([
            'tasks' =>  $tasks,
        ]);     
    }

    public function deleteTask(Request $request, $eventId, $listId){
        // CHECK IF TASK ALREADY BEEN DELETED
        if(Task::where('id', $request->task_id)->exists()){
            Task::where('id', $request->task_id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Task Deleted Successfully',
            ]);
        }

        $url = url('events/'.$eventId.'/list/'.$listId);
            return response()->json([
                'status' => 200,
                'message' => 'Task Already Been Deleted',
                'url' => $url
            ]);
    }

    public function viewTask($eventId, $listId, $taskId){
        // RETURN BACK TO PREVIOUS URL IF TASK DOESN'T EXIST
        if(!Task::where('id', $taskId)->exists()){
            return back()->with([
                'status' => 'red',
                'message' => 'Task Already Been Deleted'
            ]);
        }
        // MARK AS READ IF USER VIEWED THE TASK
        $task = Task::find($taskId);
        foreach($task->users as $user) {
            if($user->id == Auth::user()->id) {
                $user->pivot->is_read = 1;
                $user->pivot->save();
            }
        }
        $event = Event::find($eventId);
        $list = TaskList::find($listId);
        $lists = TaskList::all();
        $task = Task::find($taskId);
        $title = "Manage Events";
        $scripts = [
            asset('js/events/addActivity.js'),
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
            'files' => 'max:10000',
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
                    $extension = $file->extension();
                    $path = 'event-files/';
                    $file_path = Str::uuid() . '.' . $extension;
                    $file_name = $file->getClientOriginalName();
                    // STORE EVENT FILES 
                    $file->storeAs($path, $file_path, 'public');
                    File::create([
                        'name' => $file_name,
                        'path' => $file_path,
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

    public function downloadActivityFile($path) {
        return response()->download(storage_path('app/public/event-files/' . $path));
    }

    public function downloadEventFile($file) {  
        return response()->download(storage_path('app/public/event-files/' . $file));
    }

    public function downloadEventPrograms($file) {  
        return response()->download(storage_path('app/public/event-programs/' . $file));
    }

    public function downloadGroupFiles($file) {  
        return response()->download(storage_path('app/public/group-files/' . $file));
    }

    public function fetchFiles($taskId) {
        $files = File::where('task_id', $taskId)->get();
        return response()->json([
            'files' =>  $files,
        ]); 
    }

    public function updateTaskForm($eventId, $listId, $taskId) {
        $event = Event::find($eventId);
        $list = TaskList::find($listId);
        $lists = TaskList::all();
        $task = Task::find($taskId);
        $title = "Manage Events";
        $scripts = [
            asset('js/events/updateTask.js'),
            asset('js/modal.js'),
        ];
        return view('events.update-task', [
            'list' => $list,
            'title' => $title,
            'event' => $event,
            'task' => $task,
            'scripts' => $scripts,
            'lists' => $lists,
        ]);
    }

    public function updateTask(Request $request, $eventId, $listId, $taskId) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            // UPDATE TASK
            $task = Task::find($taskId);
            $task->title = $request->title;
            $task->description = $request->description;
            // REMOVE ALL MEMBERS FROM TASK
            $task->users()->detach();
            // INSERT NEW SET OF MEMBERS TO TASK
            $task->users()->attach($request->members);
            $task->save();
            $url = url('events/'.$eventId.'/list/'.$listId.'/task/'.$taskId);
            return response()->json([
                'status' => 200,
                'url' => $url,
            ]);
        }
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
    
    public function fetchMembers($taskId) {
        $members = Task::find($taskId)->users()->get();
        return response()->json([
            'members' => $members
        ]);
    }

    public function attendance($eventId) {
        $event = Event::find($eventId);
        // RETURN TO HOME PAGE IF TICAP IS NOT YET SET
        if($event->ticap_id == null) {
            return redirect('/');
        }

        return view('studentLogin', [
            'event' => $event,
        ]);
    }
}
