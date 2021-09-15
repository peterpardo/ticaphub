<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Officer;
use App\Models\Position;
use App\Models\School;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoterController extends Controller
{
    public function voterPanel(){
        $title = 'Officers and Committees';
        
        $officers = Officer::all();
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $school = User::find(Auth::user()->id)->userProgram->school->name;
        $specialization = User::find(Auth::user()->id)->userProgram->specialization->name;

        $users = User::with(['candidate.position', 'userProgram.school', 'userProgram.specialization'])->get();

        $positions = Position::all();
        $schools = School::where('is_involved')->get();

        return view('officers-and-committees.vote', [
            'title' => $title,
            'ticap' => $ticap->name,
            'users' => $users,
            'positions' => $positions,
            'schools' => $schools,
            'userSchool' => $school,
            'userSpecialization' => $specialization,
            'officers' => $officers,
        ]);
    }

    public function getVote(Request $request) {
        // DYNAMIC VALIDATION OF POSITIONS
        $positions = Position::all();

        $fields = [];

        foreach($positions as $position) {
            $name = str_replace(' ', '_', $position->name);
            $fields[$name] = 'required';
        }

        $request->validate($fields);
        
        $voter = User::find(Auth::user()->id);

        // DYNAMIC INSERTION OF VOTES TO CANDIDATES
        foreach($request->all() as $key => $value) {
            // SKIP _TOKEN FIELD NAME
            if($key == '_token') {
                continue;
            } 

            // REGISTER VOTE OF USER
            $user = User::find($voter->id);

            $user->votes()->create([
                'candidate_id' => $value,
                'ticap_id' => $user->ticap_id,
            ]);
        }
        
        $user = User::find($voter->id);
        $user->userProgram->has_voted = 1;
        $user->userProgram->save();

        return redirect()->route('officers');  
    }
}
