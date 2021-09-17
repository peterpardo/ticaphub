<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TaskList;
use App\Models\User;
use App\Models\UserProgram;
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
        $lists = TaskList::with(['user.userProgram.school', 'event', 'user.userProgram.specialization'])->where('event_id', $id)->get();

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
 
        $scripts = [
            asset('js/events/addTask.js'),
        ];

        return view('events.tasks', [
            'list' => $list,
            'title' => $title,
            'event' => $event,
            'scripts' => $scripts,
        ]);
    }

    public function searchMember(Request $request) {
        // dd('pasok'); 

        // dd($users);

        // if($request->ajax()){
        //     if($request->search == '') {
        //         return response('');
        //     }

        //     $search = $request->search;
        
        //     $data = User::where('first_name', 'like', '%'.$search.'%')
        //                 ->orWhere('middle_name', 'like', '%'.$search.'%')
        //                 ->orWhere('last_name', 'like', '%'.$search.'%')
        //                 ->orWhere('student_number', 'like', '%'.$search.'%')         
        //     ->get();
                        
        //     $output = '';
        
        //     if($data){
        //         foreach($data as $user){
        //             $output .=  '<p class="rounded border-2-black px-2 py-2 hover:bg-gray-200 cursor-pointer" data-id="' . $user->id . '">' . $user->userProgram->school->name . ' | ' . $user->userProgram->specialization->name . ' | ' . $user->last_name . ', ' . $user->first_name . ' ' . $user->middle_name . '</p>';
        //         }
        //     } else {
        //         $output .= 'No Results';
        //     }
    
        //     return response($output);
        // }
    }
}
