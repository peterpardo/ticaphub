<?php

namespace App\Http\Controllers;

use App\Models\Election;
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
        $user = User::find(Auth::user()->id);
        $positions = Position::all();
        $election = Election::where('specialization_id', $user->userSpecialization->specialization->id)->first();
        $scripts = [
            asset('js/officersandcommittees/vote.js'),
        ];
        // IF TICAP HAS NEW ELECTION
        if($ticap->has_new_election){   
            $officers = Officer::all();
            return view('officers-and-committees.new-vote', [
                'title' => $title,
                'ticap' => $ticap->name,
                'officers' => $officers,
                'positions' => $positions,
                'election' => $election,
            ]);
        } else {
            return view('officers-and-committees.vote', [
                'title' => $title,
                'ticap' => $ticap->name,
                'election' => $election,
                'positions' => $positions,
                'scripts' => $scripts,
            ]);
        }
    }

    public function getVote(Request $request) {
        // DYNAMIC VALIDATION OF POSITIONS
        $fields = [];
        $positions = Position::all();
        $ticap = Ticap::find(Auth::user()->ticap_id);
        if($ticap->has_new_election) {
            $elections = Election::all();
            foreach($elections as $election) {
                if($election->officers()->where('is_elected', 0)->exists()) {
                    $position = $election->officers()->where('is_elected', 0)->distinct()->pluck('position_id');
                    echo $election->name . '<br>';
                    $pos = Position::find($position[0]);
                    dd($pos) . '<br>';
                }
            }
        }
        dd('error');
        foreach($positions as $position) {
            $name = str_replace(' ', '_', $position->name);
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
            $user = User::find($voter->id);
            $user->votes()->create([
                'candidate_id' => $value,
                'ticap_id' => $user->ticap_id,
            ]);
        }
        $voter->userElection->has_voted = 1;
        $voter->userElection->save();
        return redirect()->route('officers');  
    }
}
