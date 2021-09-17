<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListController extends Controller
{
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
            ]);        }
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
        
    }
}
