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
        
        // REDIRECT TO OFFICERS PAGE
        if($ticap->election_finished) {
            return redirect()->route('officers');
        }
        
        // IF TICAP HAS NEW ELECTION
        if($ticap->has_new_election){   
            $officers = Officer::all();
            return view('officers-and-committees.new-vote', [
                'title' => $title,
                'ticap' => $ticap->name,
                'officers' => $officers,
                'positions' => $positions,
                'election' => $election,
                'scripts' => $scripts,
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
        // CHECK IF ELECTION IN REVIEW OR FINISHED
        if($ticap->election_review || $ticap->election_finished) {
            session()->flash('status', 'red');
            session()->flash('message', 'Election already done. Wait for the results.');
            return redirect()->route('officers');
        }
        // GET POSITIONS IN RE-ELECTION
        if($ticap->has_new_election) {
            $elections = Election::all();
            foreach($elections as $election) {
                if($election->officers()->where('is_elected', 0)->exists()) {
                    $position = $election->officers()->where('is_elected', 0)->distinct()->pluck('position_id');
                    $pos = Position::find($position[0]);
                    $name = str_replace(' ', '_', $pos->name);
                    if(!array_key_exists($name, $fields)){
                        $fields[$name] = 'required';
                    }
                }
            }
        } else {
            foreach($positions as $position) {
                $name = str_replace(' ', '_', $position->name);
                if(!array_key_exists($name, $fields)){
                    $fields[$name] = 'required';
                }
            }
        }
        $request->validate($fields);
        $voter = User::find(Auth::user()->id);
        foreach($request->all() as $key => $candidateId){
            if($key == '_token') {
                continue;
            }
            $voter->votes()->create([
                'candidate_id' => $candidateId,
                'ticap_id' => 1
            ]);
        }
        $voter->userElection->has_voted = 1;
        $voter->userElection->save();
        session()->flash('status', 'green');
        session()->flash('message', 'Vote submitted. Wait for the results.');
        return redirect()->route('officers');  
    }
}
