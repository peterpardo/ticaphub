<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Candidate;
use App\Models\IndividualAwardCandidate;
use App\Models\IndividualWinner;
use App\Models\Officer;
use App\Models\Position;
use App\Models\School;
use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use App\Models\Ticap;
use App\Models\User;
use App\Models\UserSpecialization;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use PDF;


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
{{  }}
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
        $ticap = Ticap::find(Auth::user()->ticap_id);
        if($ticap->election_finished) {
            return redirect()->route('officers');
        } 
        if($ticap->election_review) {
            return redirect()->route('election-result');
        }
        if($ticap->election_has_started) {
            return redirect()->route('election');
        }
        $title = 'Officers and Committees';
        $scripts = [
            asset('js/officersandcommittees/positions.js'),
        ];
        return view('officers-and-committees.positions', [
            'title' => $title,
            'ticap' => $ticap->name,
            'scripts' => $scripts,
        ]);
    }

    public function fetchPositions(){
        $positions = Position::all();
        return response()->json([
            'positions' =>  $positions,
        ]);
    }

    public function setCandidates() {
        $ticap = Ticap::find(Auth::user()->ticap_id);
        if($ticap->election_finished) {
            return redirect()->route('officers');
        } 
        if($ticap->election_review) {
            return redirect()->route('election-result');
        }
        if($ticap->election_has_started) {
            return redirect()->route('election');
        }
        if($ticap->election_has_started) {
            return back();
        }
        // CHECK IF POSITIONS ARE ENOUGH FOR THE ELECTION
        if(Position::all()->count() < 2 ){
            session()->flash('status', 'red');
            session()->flash('message', 'Add more positions for the election');
            return back();
        }
        $scripts = [
            asset('js/officersandcommittees/candidates.js'),
        ];
        $title = 'Officers and Committees';
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
                    $output .=  '<p class="rounded border-2-black px-2 py-2 hover:bg-gray-200 cursor-pointer" data-id="' . $user->id . '">' . $user->school->name . ' | ' . $user->userSpecialization->specialization->name . ' | ' . $user->last_name . ', ' . $user->first_name . ' ' . $user->middle_name . '</p>';
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
                'specialization_id' => $user->userSpecialization->specialization_id,
                'school_id' => $user->school->id
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Position Added SuccessFully',
            ]);
        }
    }

    public function fetchCandidates(){
        $users = User::with(['candidate.position', 'userSpecialization.specialization'])->get();
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
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $ticap->election_has_started = 1;
        $ticap->save();
        if($ticap->election_finished) {
            return redirect()->route('officers');
        }
        if($ticap->election_review) {
            return redirect()->route('election-result');
        }
        $title = 'Officers and Committees';
        $scripts = [
            asset('js/officersandcommittees/election.js'),
        ];
        return view('officers-and-committees.election', [
            'title' => $title, 
            'ticap' => $ticap->name, 
            'scripts' => $scripts, 
        ]);
    }

    public function getElectionResults(){
        $specializations = Specialization::all();
        $schools = School::all();
        $positions = Position::all();
        $users = User::role('student')->get();
        // TEMP CONTAINER FOR COUNTING OF VOTES
        $winners = [];
        // SCHOOL
        foreach($schools as $school) {
            // CHECK IF SCHOOL IS INVOLVED IN TICAP
            if($school->is_involved){
                // SPECIALIZATION
                foreach($specializations as $specialization) {
                    $userCountPerSpecialization = UserSpecialization::where('specialization_id', $specialization->id)->where('school_id', $school->id)->count();
                    // RETURN TRUE IF VOTES PER SPECIALIZATION IS LESS THAN HALF OF THE USERS IN THE SPECIALIZATION
                    if(UserSpecialization::where('has_voted', 1)->where('specialization_id', $specialization->id)->where('school_id', $school->id)->count() < (int)round($userCountPerSpecialization/2)){
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
                            if($candidate->user->officer == null || !$candidate->user->officer->exists()){
                                $candidate->user->officer()->create([
                                    'position_id' => $candidate->position->id,
                                    'ticap_id' => $candidate->user->ticap_id,
                                    'is_elected' => 1,
                                ]);
                            }  
                        } 
                        // RUNS IF THERE ARE MORE THAN ONE RESULT
                        if(count($final) > 1){
                            foreach($final as $candidate_id){
                                // INSERT CANDIDATE TO OFFICERS TABLE WITH (IS_ELECTED = FALSE)
                                $candidate = Candidate::find($candidate_id);
                                if($candidate->user->officer == null || !$candidate->user->officer->exists()){
                                    $candidate->user->officer()->create([
                                        'position_id' => $candidate->position->id,
                                        'ticap_id' => $candidate->user->ticap_id,
                                    ]);
                                }
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
        $title = 'Officers and Committees';
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $scripts = [
            asset('js/officersandcommittees/confirmElection.js'),
        ];
        return view('officers-and-committees.election-results', [
            'title' => $title,
            'ticap' => $ticap->name,
            'scripts' => $scripts,
        ]);
    }

    public function newElectionPanel() {
        $title = 'Officers and Committees';
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $scripts = [
            asset('js/officersandcommittees/newElection.js'),
        ];
        return view('officers-and-committees.new-election', [
            'title' => $title,
            'ticap' => $ticap->name,
            'scripts' => $scripts,
        ]);
    }

    public function getNewElectionResults() {
        // TEMP CONTAINER FOR COUNTING OF VOTES
        $winners = [];
        $positions = [];
        $specializations = [];
        $schools = [];
        // GET INFO OF OFFICERS
        $officers = Officer::where('is_elected', 0)->get();
        foreach($officers as $officer){
            if(!in_array($officer->user->candidate->position->id, $positions)){
                array_push($positions, $officer->user->candidate->position->id);
            }
            if(!in_array($officer->user->candidate->specialization->id, $specializations)){
                array_push($specializations, $officer->user->candidate->specialization->id);
            }
            if(!in_array($officer->user->candidate->school->id, $schools)){
                array_push($schools, $officer->user->candidate->school->id);
            }
        }
        // dd($specializations);
        foreach($schools as $school) {
            foreach($specializations as $specialization){
                foreach($positions as $position){
                    foreach($officers as $officer){
                        $userCountPerSpecialization = UserSpecialization::where('specialization_id', $specialization)->where('school_id', $school)->count();
                        // RETURN TRUE IF VOTES PER SPECIALIZATION IS LESS THAN HALF OF THE USERS IN THE SPECIALIZATION
                        if(UserSpecialization::where('has_voted', 1)->where('specialization_id', $specialization)->where('school_id', $school)->count() < (int)round($userCountPerSpecialization/2)){
                            $sch = School::find($school);
                            $spec = Specialization::find($specialization);
                            return back()->with('error', 'The ' . $sch->name . '(' . $spec->name . ') needs more votes.');
                        }
                        if(
                            $officer->user->candidate->school->id == $school &&
                            $officer->user->candidate->specialization->id == $specialization &&
                            $officer->user->candidate->position->id == $position
                        ) {
                            // COUNT VOTES FOR OFFICER
                            $votes = Vote::where('candidate_id', $officer->user->candidate->id)->count();
                            $winners[$officer->user->id] = $votes;
                        }
                    }
                    // CHECK WINNERS OF THE ELECTION - RETURNS THE WINNER OF THE ELECTION
                    $final = array_keys($winners, max($winners));
                    // RUNS IF THERE IS ONLY ONE WINNER
                    if(count($final) == 1) {
                        $loser = array_keys($winners, min($winners));
                        // UPDATE OFFICER AS ELECTED AND DELETE LOSER
                        Officer::where('user_id', $final[0])->update(['is_elected' => 1]);
                        Officer::where('user_id', $loser[0])->delete();
                    } 
                    // RUNS IF THERE ARE MORE THAN ONE RESULT
                    if(count($final) > 1){
                        foreach($final as $candidate_id){
                            // DELETE ALL LOSERS
                            foreach($winners as $id => $votes){
                                if($id == $candidate_id){
                                    continue;
                                }
                                Officer::where('user_id', $id)->delete();
                            }
                        }
                    }
                    $winners = [];
                }
            }
        }
        return redirect()->route('election-result');
    }

    public function endElection() {
        // RETURNS TRUE OF RE-ELECTION IS NEEDED
        if(Officer::where('is_elected', 0)->exists()){
            $ticap = Ticap::find(Auth::user()->id);
            $ticap->has_new_election = 1;
            $ticap->save();
            $officers = Officer::where('is_elected', 0)->get();
            foreach($officers as $officer) {
                // DELETE VOTES OF THE RE-ELECTED CANDIDATES
                Vote::where('candidate_id', $officer->user->candidate->id)->delete();
                // REMOVE VOTES OF STUDENTS TO VOTE AGAIN
                $users = UserSpecialization::where('specialization_id', $officer->user->candidate->specialization->id)->get();
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
            if($officer->user->candidate->position->name == 'Chairman'){
                $officer->user->assignRole('chairman');
            } else {
                $officer->user->assignRole('officer');
            }
        }
        return redirect()->route('officers');
    }

    public function appointForm() {
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $user = User::find(Auth::user()->id);
        if(!$ticap->election_finished) {
            session()->flash('status', 'red');
            session()->flash('message', 'Appoint officers first.');
            return redirect()->route('dashboard');
        }
        if(!$user->hasPermissionTo('appoint committee head')){
            return redirect()->route('dashboard');
        }
        $title = 'Officer and Committes';
        $scripts = [
            asset('js/committees/committee.js')
        ];
        return view('officers-and-committees.committee-heads', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }

    public function generateOfficers() {
        $data = [
            'officers' => Officer::orderBy('election_id', 'asc')->get(),
            'ticap' => Ticap::find(Auth::user()->ticap_id)
        ];
        $pdf = PDF::loadView('reports.officers', $data);
        return $pdf->download(time().'-officers.pdf');
    }
    public function test() {
        // $winners = IndividualWinner::all();
        // $specs = Specialization::all();
        // foreach($specs as $spec) {
        //     echo '<strong>' . $spec->name . '</strong><br>';
        //     foreach($spec->awards as $award) {
        //         if($award->type == 'individual') {
        //             echo $award->name . '<br>';
        //             foreach($award->individualWinners as $winner) {
        //                 $users = [];
        //                 echo $winner->group->name . '<br>';
        //                 foreach($winner->group->userGroups as $userGroup) {
        //                     array_push($users, $userGroup->user->id);
        //                 }
        //                 for($i = 0; $i < $spec->panelists->count(); $i++) {
        //                     $key = array_rand($users);
        //                     $winner->group->individualCandidates()->create([
        //                         'user_id' => $users[$key]
        //                     ]);
        //                     echo 'panelist ' . $i+1 . ' : ' . $users[$key] . '<br>';
        //                 }
        //             }
        //         }
        //     }
        // }
        // dd($winners);
        // foreach($winners as $winner) {
        //     $users = [];
        //     echo $winner->group->specialization->name . '<br>';
        //     echo $winner->group->name . '<br>';
        //     foreach($winner->group->userGroups as $userGroup) {
        //         echo $userGroup->user->id . '<br>';
        //         array_push($users, $userGroup->user->id);
        //     }   
        //     $key = array_rand($users);
        //     $x = $winner->group->individualCandidates()->create([
        //         'user_id' => $users[$key]
        //     ]);
        //     echo '<br>';
        // }
    }
}
