<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Event;
use App\Models\Officer;
use App\Models\Position;
use App\Models\School;
use App\Models\Slider;
use App\Models\Stream;
use App\Models\Ticap;
use App\Models\User;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

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
        $user = User::find(Auth::user()->id);
        if($user->ticap_id == null) {
            $ticap = 'No TICaP is set';
        } else {
            $ticap = Ticap::where('id', $user->ticap_id)->pluck('name')->first();
        }
        return view('dashboard', [
            'title' => $title,
            'ticap' => $ticap,
            'user' => $user,
            'students' => User::role('student')->get(),
            'panelists' => User::role('panelist')->get(),
            'officers' => User::role('officer')->get(),
            'admins' => User::role('admin')->get(),
            'events' => Event::all(),
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
                session()->flash('error', 'Manage settings for TICaP first');
                return redirect()->route('set-invitation');
            }
            if($ticap->election_review) {
                return redirect()->route('election-result');
            }
            if($ticap->election_has_started && !$ticap->election_has_started && $ticap->has_new_election) {
                return redirect()->route('new-election');
            }
            if($ticap->election_has_started && !$ticap->election_finished) {
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

    public function HomeSlider(){
        $sliders = Slider::latest()->get();
        return view('slider.index', compact('sliders'));
    }

    public function AddSlider(){
        return view('slider.add-slider');
    }

    public function StoreSlider(Request $request){

        $image = $request->file('image');

        // $name_gen = hexdec(uniqid());
        // $img_ext =strtolower($image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/slider';
        // $last_img = $up_location.$img_name;
        // $image->move($up_location,$img_name);

        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // dito yung error
        Image::make($image)->resize(1920, 1080)->save('image/slider'.$name_gen);

        $last_img = 'image/slider'.$name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

           return redirect()->route('home.slider');
    }

    public function deleteSlider($id){
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return redirect()->route('home.slider');
    }

    //STREAM LINK
    public function HomeStream(){
        $streams = Stream::latest()->get();
        return view('stream.index', compact('streams'));
    }

    public function AddStream(){
        return view('stream.add-stream');
    }

    public function StoreStream(Request $request){
        Stream::insert([
            'title' => $request->title,
            'description' => $request->description,
            'stream_link' => $request->stream,
            'created_at' => Carbon::now()
        ]);
           return redirect()->route('home.stream');
    }

    public function deleteStream($id){
        Stream::find($id)->delete();
        return redirect()->route('home.stream');
    }

}
