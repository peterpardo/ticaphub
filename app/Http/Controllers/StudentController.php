<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index() {
        $group = Auth::user()->userGroup->group;
        $title = $group->name . ' Exhibit';
        $scripts = [
            asset('js/groupexhibit/group.js')
        ];
        return view('group-exhibit.index', [
            'title' => $title,
            'scripts' => $scripts,
            'group' => $group,
        ]);
    }
    public function updateForm($groupId) {
        $group = Group::find($groupId);
        $title = $group->name . ' Exhibit';
        return view('group-exhibit.update', [
            'title' => $title,
            'group' => $group,
        ]);
    }
    public function update(Request $request, $groupId) {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            // 'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
        ]);
        dd($request->video);
        $group = Group::find($groupId);
        $group->groupExhibit()->update($validated);
        session()->flash('status', 'green');
        session()->flash('message', 'Exhibit successfully updated');
        return redirect()->route('exhibit');
    }

    public function vote($id) {
        $student = User::where('id', auth()->user()->id)->with('userElection')->first();
        $election = Election::find($id);

        // Check if student has voted
        if ($student->userElection->has_voted) {
            return redirect('officers/elections/' . $election->id);
        }

        return view('officers.vote', [
            'election' => $election
        ]);
    }
}
