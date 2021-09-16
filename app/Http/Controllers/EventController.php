<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index(){
        $title = 'Manage Events';

        $scripts = [
            asset('js/events/addEvent.js'),
        ];

        return view('events.index', [
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

        return view('events.view', [
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

            $event->taskLists()->create([
                'title' => $request->title
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'List Added SuccessFully',
            ]);
        }
    }

    public function fetchLists($id){
        $lists = TaskList::where('event_id', $id)->get();

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

        $title = "Manage Events";
        // return view('')
    }
}
