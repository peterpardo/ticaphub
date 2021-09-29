<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Officer;
use App\Models\Position;
use App\Models\School;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function setTicap() {
        return view('set-ticap');
    }

    public function addTicap(Request $request) {
        $request->validate([
            'ticap' => 'required|unique:ticaps,name'
        ]);
        // INSERT TICAP NAME TO TICAPS TABLE
        $ticap = Ticap::create([
            'name' => $request->ticap,
        ]);
        // FIND ADMIN ID
        $admin = User::find(1);
        // SET TICAP_ID OF ADMIN TO PRESENT TICAP
        $admin->ticap_id = $ticap->id;
        $admin->save();
        return redirect('dashboard');
    }

    public function dashboard() {
        $title = 'Dashboard';
        $ticap = Ticap::find(Auth::user()->ticap_id);
        return view('dashboard', [
            'title' => $title,
            'ticap' => $ticap->name
        ]);
    }

    public function users() {
        // REDIRECTS TO SET OF INVITATION TO USERS
        $ticap = Ticap::find(Auth::user()->ticap_id);
        if(!$ticap->invitation_is_set){
            return redirect()->route('set-invitation');
        }
        $title = 'User Accounts';
        $scripts = [
            asset('js/useraccounts/users.js')
        ];
        return view('user-accounts.users', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }

    public function officers() {
        $title = 'Officers and Committees';
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $user = User::find(Auth::user()->id);
        // REDIRECT ADMIN TO SETTING OF POSITIONS IF ELECTION HAS NOT BEEN SET
        if ($user->hasRole('admin')) {
            if(!$ticap->invitation_is_set){
                return redirect()->route('set-invitation');
            }
            if($ticap->election_review) {
                return redirect()->route('election-result');
            }
            if($ticap->election_has_started && !$ticap->election_has_started && $ticap->has_new_election) {
                return redirect()->route('new-election');
            }
            if($ticap->election_has_started && !$ticap->election_has_started) {
                return redirect()->route('election');
            }elseif(!$ticap->election_has_started){
                return redirect()->route('set-positions');
            }
        }
        // REDIRECT STUDENT WHETHER ELECTION HAS STARTED OR NOT AND HAS NOT YET VOTED
        if ($user->hasRole('student')) {
            if($ticap->election_has_started && !$user->userElection->has_voted) {
                return redirect()->route('vote');
            }
        }
        $elections = Election::all();
        $positions = Position::all();
        // CHECK IF STUDENT IS FROM FEUTECH
        if($user->hasRole('student')) {
            if($user->userSpecialization->specialization->school->id == 1){
                $elections = Election::where('specialization_id', $user->userSpecialization->specialization->id)->get();
            } else {
                $elections = Election::where('name', $user->userSpecialization->specialization->school->name)->get();
            }
        }
        return view('officers-and-committees.officers', [
            'title' => $title,
            'ticap' => $ticap,
            'elections' => $elections,
            'positions' => $positions,
            'user' => $user,
        ]);
    }

    public function test() {
        return view('welcome');
    }

}
