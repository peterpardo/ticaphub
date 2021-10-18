<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Event;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function getEvents() {
        $events = Event::all();

        return $events;
    }

    public function showEvent($eventId) {
        $event = Event::where('id', $eventId)->with(['lists', 'lists.tasks'])->get();

        return $event;
    }

    public function createEvent(Request $request) {
        $request->validate([
            'name' => 'required|string'
        ]);

        Event::create([
            'name' => $request->name,
            'ticap_id' => Auth::user()->ticap_id, 
        ]);

        return 'Event has been created';
    }

    public function updateEvent(Request $request, $eventId) {
        $request->validate([
            'name' => 'required|string'
        ]);

        Event::find($eventId)->update(['name' => $request->name]);

        return 'Event has been updated.';
    }

    public function deleteEvent($eventId) {
        Event::find($eventId)->delete();

        return 'Event has been deleted.';
    }

    public function createList(Request $request, $eventId) {
        $request->validate([
            'title' => 'required|string'
        ]);

        $event = Event::find($eventId);

        $event->lists()->create([
            'title' => $request->title,
            'user_id' => Auth::user()->id,
        ]);

        return 'List has been created.';
    }

    // public function showList($eventId, $listId) {
    //     $list = TaskList::where('id', $listId)->with(['tasks'])->get();

    //     return response([
    //         'list' => $list,
    //     ]);
    // }

    public function updateList(Request $request, $eventId, $listId) {
        $request->validate([
            'title' => 'required|string'
        ]);

        TaskList::where('id', $listId)->update(['title' => $request->title]);

        return 'List has been updated.';
    }

    public function deleteList($eventId, $listId) {
        TaskList::find($listId)->delete();

        return 'List has been deleted.';
    }

    public function createTask(Request $request, $eventId, $listId) {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'list_id' => $listId,
        ]);

        if($request->members){
            foreach($request->members as $member){
                $task->users()->attach($member);
            }
        }

        return 'Task has been created.';
    }

    public function showTask($eventId, $listId, $taskId) {
        $task = Task::where('id', $taskId)->with(['activities', 'activities.user', 'activities.files', 'taskCreator', 'users'])->get();

        return $task;
    }

    public function updateTask(Request $request, $eventId, $listId, $taskId) {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $task = Task::find($taskId);
        $task->update($request->all());
        $task->save();

        $task->users()->detach();

        if($request->members){
            foreach($request->members as $member){
                $task->users()->attach($member);
            }
        }

        return 'Task has been updated.';
    }

    public function deleteTask($eventId, $listId, $taskId) {
        Task::find($taskId)->delete();

        return 'Task has been deleted.';
    }

    public function createActivity(Request $request, $eventId, $listId, $taskId) {
        $request->validate([
            'description' => 'required|string',
        ]);

        $activity = Activity::create([
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'task_id' => $taskId
        ]);

        return $activity;
    }

}
