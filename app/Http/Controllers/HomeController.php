<?php

namespace App\Http\Controllers;

use App\Models\Officer;
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
        $title = 'User Accounts';
        
        $scripts = [
            asset('js/modal.js'),
        ];
        
        $users = User::paginate(6);

        return view('user-accounts.users', [
            'title' => $title,
            'users' => $users,
            'scripts' => $scripts,
        ]);
    }

    public function officers() {
        $officers = Officer::with(['candidate.user', 'candidate.position'])->get();

        $title = 'Officers and Committees';
        $ticap =Ticap::find(Auth::user()->ticap_id);
        $user = User::find(Auth::user()->id);

        return view('officers-and-committees.officers', [
            'title' => $title,
            'ticap' => $ticap,
            'officers' => $officers,
            'user' => $user,
        ]);
    }

    public function test() {
        return view('welcome');
    }

}
