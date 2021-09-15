<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Officer;
use App\Models\Position;
use App\Models\School;
use App\Models\Specialization;
use App\Models\Ticap;

;
use App\Models\User;
use App\Models\UserProgram;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class ElectionController extends Controller
{
    public function addPosition(Request $request) {
        $validator = Validator::make($request->all(), [
            'position' => 'required|max:100',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            $position = new Position();
            $position->name = Str::title($request->input('position'));
            $position->save();
            return response()->json([
                'status' => 200,
                'message' => 'Position Added SuccessFully',
            ]);
        }

    }

    public function deletePosition(Request $request) {
        $validator = Validator::make($request->all(), [
            'position' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            $position = Position::find($request->position);

            $position->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Position Deleted SuccessFully',
            ]);
        }

    }

    public function setPositions() {
        $title = 'Officers and Committees';

        $ticap = Auth::user()->ticap_id;

        $ticap = Ticap::find($ticap)->first();

        $scripts = [
            asset('js/modal.js'),
            asset('js/officersandcommittees/addPosition.js'),
        ];

        return view('officers-and-committees.positions', [
            'title' => $title,
            'scripts' => $scripts,
            'ticap' => $ticap->name
        ]);
    }

    public function fetchPositions(){
        $positions = Position::all();

        return response()->json([
            'positions' =>  $positions,
        ]);
    }

    public function setCandidates() {
        $title = 'Officers and Committees';

        $scripts = [
            asset('js/modal.js'),
            asset('js/officersandcommittees/appointCandidate.js'),
            // asset('js/officersandcommittees/datatable.js'),
        ];

        return view('officers-and-committees.candidates', [
                'title' => $title,
                'scripts' => $scripts,
        ]);
    }

    public function search(Request $request) {
        // EXPECTS AJAX
        if($request->ajax()){
            if($request->search == '') {
                return response('');
            }

            $search = $request->search;
        
            $data = User::where('first_name', 'like', '%'.$search.'%')
                        ->orWhere('middle_name', 'like', '%'.$search.'%')
                        ->orWhere('last_name', 'like', '%'.$search.'%')
                        ->orWhere('student_number', 'like', '%'.$search.'%')         
            ->get();
                        
            $output = '';
        
            if($data){
                foreach($data as $user){
                    $output .=  '<p class="rounded border-2-black px-2 py-2 hover:bg-gray-200 cursor-pointer" data-id="' . $user->id . '">' . $user->userProgram->school->name . ' | ' . $user->userProgram->specialization->name . ' | ' . $user->last_name . ', ' . $user->first_name . ' ' . $user->middle_name . '</p>';
                }
            } else {
                $output .= 'No Results';
            }
    
            return response($output);
        }
    }   

    public function addCandidate(Request $request) {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|unique:candidates,user_id',
            'position' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            // INSERT USER AS CANDIDATE
            $user = User::find($request->student_name);

            $user->candidate()->create([
                'position_id' => $request->position,
                'specialization_id' => $user->userProgram->specialization_id,
                'school_id' => $user->userProgram->school->id
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Position Added SuccessFully',
            ]);
        }
    }

    public function fetchCandidates(){
        $users = User::with(['candidate.position', 'userProgram.school', 'userProgram.specialization'])->get();
        
        return response()->json([
            'users' =>  $users,
        ]);
    }

    public function deleteCandidate(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'position_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            $user = User::find($request->user_id);
            $user->candidate->delete();
            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'Position Added SuccessFully',
            ]);
        }
    }

    public function electionPanel() {
        $positions = Position::all();

        // CHECK IF CANDIDATES EXIST
        if (Candidate::all()->count() == 0) {
            return back()->with('error', 'Please add Candidates');
        }

        // CHECK IF CANDIDATES EXIST FOR EACH POSITION ON EACH SPECIALIZATION
        $positions = Position::all();
        $specializations = Specialization::all();
        foreach($specializations as $specialization) {
            foreach($positions as $position){
                if($position->candidates->where('specialization_id', $specialization->id)->count() < 2){
                    return back()->with('error','Specialization: "' . $specialization->name . '" *Please add more candidates for the position: ' . $position->name . ' (min. of 2 candidates)' );
                }
            }
        }

        $title = 'Officers and Committees';
        
        // UPDATE TO ELECTION HAS STARTED
        $ticap = Auth::user()->ticap_id;
        $ticap = Ticap::find($ticap);
        $ticap->election_has_started = 1;
        $ticap->save();

        // GIVE VIEW ACCESS TO ALL MODELS RELATED TO USER
        $users = User::with(['candidate.position', 'userProgram.school', 'userProgram.specialization'])->get();
        $positions = Position::all();
        $schools = School::all();
        $specializations = Specialization::all();

        return view('officers-and-committees.election', [
            'title' => $title, 
            'ticap' => $ticap->name, 
            'users' => $users,
            'positions' => $positions,
            'schools' => $schools,
            'specializations' => $specializations,
        ]);
    }

    public function getElectionResults(){
        $specializations = Specialization::all();
        $schools = School::all();
        $positions = Position::all();
        $users = User::all();

        // SET USER TO HAS VOTED
        foreach($users as $user){
            $user->userProgram->has_voted = 1;
            $user->userProgram->save();
        }

        // TEMP CONTAINER FOR COUNTING OF VOTES
        $winners = [];

        // SCHOOL
        foreach($schools as $school) {

            // CHECK IF SCHOOL IS INVOLVED IN TICAP
            if($school->is_involved){

                // SPECIALIZATION
                foreach($specializations as $specialization) {
                    $userCountPerSpecialization = UserProgram::where('specialization_id', $specialization->id)->count();

                    // RETURN TRUE IF VOTES PER SPECIALIZATION IS LESS THAN HALF OF THE USERS IN THE SPECIALIZATION
                    if(UserProgram::where('has_voted', 1)->where('specialization_id', $specialization->id)->count() < (int)round($userCountPerSpecialization/2)){
                        return back()->with('error', 'The ' . $school->name . '(' . $specialization->name . ') needs more votes.');
                    }
                    
                    // POSITION
                    foreach($positions as $position){

                        // FINDS CANDIDATES 
                        foreach($users as $user){

                            // CHECK IF USER IS A CANDIDATE
                            if($user->candidate != null){
                                if($user->candidate->specialization->id == $specialization->id && $user->candidate->position->id == $position->id && $user->candidate->school->id == $school->id){
                                    $votes = Vote::where('candidate_id', $user->candidate->id)->count();

                                    // CONTAIN ALL CANDIDATES AND VOTES IN AN ARRAY
                                    $winners[$user->candidate->id] = $votes;
                                }
                            }
                        }

                        // CHECK WINNERS OF THE ELECTION - RETURNS THE WINNER OF THE ELECTION
                        $final = array_keys($winners, max($winners));

                        // RUNS IF THERE IS ONLY ONE WINNER
                        if(count($final) == 1) {

                            // INSERT CANDIDATE TO OFFICERS TABLE (IS_ELECTED = TRUE)
                            $candidate = Candidate::find($final[0]);
                            $candidate->officer()->create([
                                'ticap_id' => $candidate->user->ticap_id,
                                'is_elected' => 1,
                            ]);

                        } 
                        
                        // RUNS IF THERE ARE MORE THAN ONE RESULT
                        if(count($final) > 1){
                            foreach($final as $candidate_id){
                                
                                // INSERT CANDIDATE TO OFFICERS TABLE WITH (IS_ELECTED = FALSE)
                                $candidate = Candidate::find($candidate_id);
                                $candidate->officer()->create([
                                    'ticap_id' => $candidate->user->ticap_id,
                                ]);

                                // DELETE VOTES OF THE CANDIDATES
                                Vote::where('candidate_id', $candidate->id)->delete();
                                
                            }

                        }

                        // ASSIGN ROLES TO THE POSITIONS
                        $chairman = Role::findByName('chairman');
                        $officer = Role::findByName('officer');

                        // CHECK IF POSITION HAS NO ROLE YET ASSIGNED
                        if($position->positionHasRole == null) {

                            // ASSIGN CHAIRMAN ROLE TO CHAIRMAN 
                            if($position->name == 'Chairman'){
                                $position->positionHasRole()->create([
                                    'role_id' => $chairman->id
                                ]);
                            } else {
                                $position->positionHasRole()->create([
                                    'role_id' => $officer->id
                                ]);
                            }
                        }

                        $winners = [];
                    }
                }
            }
        }

        return redirect()->route('election-result');

    }

    public function electionResults(){
        $officers = Officer::with(['candidate.user', 'candidate.position'])->get();

        $title = 'Officers and Committees';
        $ticap = Ticap::find(Auth::user()->id)->first();

        return view('officers-and-committees.election-results', [
            'title' => $title,
            'ticap' => $ticap->name,
            'officers' => $officers,
        ]);

    }

    public function newElectionPanel() {
        $officers = Officer::with(['candidate.user', 'candidate.position'])->get();

        $title = 'Officers and Committees';
        $ticap = Ticap::find(Auth::user()->id)->first();

        return view('officers-and-committees.new-election', [
            'title' => $title,
            'ticap' => $ticap->name,
            'officers' => $officers,
        ]);
    }

    public function getNewElectionResults() {
        $users = User::all();
        // SET USER TO HAS VOTED
        // foreach($users as $user){
        //     $user->userProgram->has_voted = 1;
        //     $user->userProgram->save();
        // }

        // TEMP CONTAINER FOR COUNTING OF VOTES
        $winners = [];
        $positions = [];
        $specializations = [];
        $schools = [];

        // GET INFO OF OFFICERS
        $officers = Officer::where('is_elected', 0)->get();
        foreach($officers as $officer){
            if(!in_array($officer->candidate->position->id, $positions)){
                array_push($positions, $officer->candidate->position->id);
            }
            if(!in_array($officer->candidate->specialization->id, $specializations)){
                array_push($specializations, $officer->candidate->specialization->id);
            }
            if(!in_array($officer->candidate->school->id, $schools)){
                array_push($schools, $officer->candidate->school->id);
            }
        }

        foreach($schools as $school) {
            foreach($specializations as $specialization){
                foreach($positions as $position){
                    foreach($officers as $officer){
                        if(
                            $officer->candidate->school->id == $school &&
                            $officer->candidate->specialization->id == $specialization &&
                            $officer->candidate->position->id == $position
                        ) {
                            // COUNT VOTES FOR OFFICER
                            $votes = Vote::where('candidate_id', $officer->candidate->id)->count();
                            $winners[$officer->candidate->id] = $votes;
                        }
                    }

                    // CHECK WINNERS OF THE ELECTION - RETURNS THE WINNER OF THE ELECTION
                    $final = array_keys($winners, max($winners));

                    // RUNS IF THERE IS ONLY ONE WINNER
                    if(count($final) == 1) {
                        $loser = array_keys($winners, min($winners));

                        // UPDATE OFFICER AS ELECTED AND DELETE LOSER
                        Officer::where('candidate_id', $final[0])->update(['is_elected' => 1]);
                        Officer::where('candidate_id', $loser[0])->delete();
                    } 
                    
                    // RUNS IF THERE ARE MORE THAN ONE RESULT
                    if(count($final) > 1){
                        foreach($final as $candidate_id){
                            dd($final);
                            // DELETE ALL LOSERS
                            foreach($winners as $id => $votes){
                                if($id == $candidate_id){
                                    continue;
                                }
                                dd('deleted');
                                Officer::where('candidate_id', $id)->delete();
                            }
                            
                            // DELETE VOTES OF THE CANDIDATES
                            Vote::where('candidate_id', $candidate_id)->delete();   
                        }
                    }

                    $winners = [];
                }
            }
        }

        return redirect()->route('election-result');
    }

    public function endElection() {
        // ALLOW USERS TO VOTE AGAIN AND RETURN TO NEW ELECTION
        if(Officer::where('is_elected', 0)->exists()){
            $ticap = Ticap::find(Auth::user()->id);
            $ticap->has_new_election = 1;
            $ticap->save();

            $officers = Officer::where('is_elected', 0)->get();

            foreach($officers as $officer) {
                $users = UserProgram::where('specialization_id', $officer->candidate->specialization->id)->get();
                foreach($users as $user){
                    if($user->has_voted){
                        $user->has_voted = 0;
                        $user->save();
                    }
                }
            }
            
            return redirect()->route('new-election');
        }

        // SET ELECTION FINISHED FOR THE TICAP
        $ticap = Ticap::find(Auth::user()->id);
        $ticap->election_finished = 1;
        $ticap->has_new_election = 0;
        $ticap->save();

        // ASSIGNMENT OF ROLES TO ELECTED OFFICERS
        $officers = Officer::all();
        foreach($officers as $officer) {
            if($officer->candidate->position->name == 'Chairman'){
                $officer->candidate->user->assignRole('chairman');
            } else {
                $officer->candidate->user->assignRole('officer');
            }
        }

        return redirect()->route('officers');

    }

    public function test() {
        $user = User::find(4);

        $user->candidate()->create([
            'position_id' => 1,
        ]);
        
        dd($user->candidate->position->name);   
    }

}
