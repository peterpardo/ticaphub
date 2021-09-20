<?php

namespace App\Http\Controllers;


use App\Models\Officer;
use App\Models\Position;
use App\Models\School;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VoterController extends Controller
{
    public function voterPanel(){
        $title = 'Officers and Committees';
        
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $school = User::find(Auth::user()->id)->school;
        $specialization = User::find(Auth::user()->id)->userSpecialization->specialization;
        $positions = Position::all();
        $schools = School::where('is_involved')->get();

        // IF TICAP HAS NEW ELECTION
        if($ticap->has_new_election){   
            $officers = Officer::all();
            return view('officers-and-committees.new-vote', [
                'title' => $title,
                'ticap' => $ticap->name,
                'officers' => $officers,
                'positions' => $positions,
                'school' => $school,
                'specialization' => $specialization,
            ]);
        } else {
            $users = User::with(['candidate.position', 'userSpecialization.specialization'])->get();

            return view('officers-and-committees.vote', [
                'title' => $title,
                'ticap' => $ticap->name,
                'users' => $users,
                'positions' => $positions,
                'schools' => $schools,
                'school' => $school,
                'specialization' => $specialization,
            ]);
        }
        
    }

    public function getVote(Request $request) {
        // DYNAMIC VALIDATION OF POSITIONS
        $fields = [];
        $officers = Officer::where('is_elected', 0)->get();
        foreach($officers as $officer) {
            $name = str_replace(' ', '_', $officer->candidate->position->name);
            if(!array_key_exists($name, $fields)){
                $fields[$name] = 'required';
            }
           
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
        $user->userSpecialization->has_voted = 1;
        $user->userSpecialization->save();

        return redirect()->route('officers');  
    }
}
