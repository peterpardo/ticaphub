<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Event;
use App\Models\Position;
use App\Models\Slider;
use App\Models\Stream;
use App\Models\Brand;
use App\Models\School;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function dashboard() {
        $user = User::find(Auth::user()->id);

        // Check if ticap is set
        if (is_null($user->ticap_id)) {
            return view('set-ticap');
        } else {
            $ticap = Ticap::find($user->ticap_id)->pluck('name')->first();

            return view('dashboard', [
                'user' => $user,
                'ticap' => $ticap,
                'students' => User::role('student')->count(),
                'panelists' => User::role('panelist')->count(),
                'officers' => User::permission('access manage events')->count(),
                'admins' => User::role('admin')->count(),
                'events' => Event::all(),
            ]);
        }
    }

    public function addTicap(Request $request) {
        $validator = Validator::make($request->all(), [
            'ticap' => 'required|unique:ticaps,name|max:20'
        ]);

        // Return error response
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        // Create ticap
        $ticap = Ticap::create([
            'name' => Str::upper($request->input('ticap')),
        ]);

        // Get admins
        $admins = User::role('superadmin')->get();

        // Set ticap id of admins
        foreach($admins as $admin) {
            $admin->ticap_id = $ticap->id;
            $admin->save();
        }

        // Set ticap id of default events
        foreach(Event::all() as $event) {
            $event->ticap_id = $ticap->id;
            $event->save();
        }

        // Set flash data
        $request->session()->flash('status', 'green');
        $request->session()->flash('message', 'Welcome to TICAPHUB! TICAP has been set.');

        return response()->json([
            'success' => route('dashboard')
        ]);
    }

    public function users() {
        $ticap = Ticap::find(Auth::user()->ticap_id);

        // Check if ticap settings has not yet been set
        if (!$ticap->invitation_is_set) {
            return view('user-accounts.set-schools');
        } else {
            // $title = 'User Accounts';
            // $scripts = [
            //     asset('js/useraccounts/users.js')
            // ];

            // return view('user-accounts.users', [
            //     'title' => $title,
            //     'scripts' => $scripts,
            // ]);

            return view('users');
        }
    }

    public function getSchools() {
        $schools = School::with(['specializations'])->get();

        return response()->json($schools);
    }

    public function updateSchoolStatus(Request $request) {
        dd($request->all());
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
            if($ticap->election_has_started && $ticap->has_new_election) {
                return redirect()->route('new-election');
            }
            if($ticap->election_has_started && !$ticap->election_finished) {
                return redirect()->route('election');
            }elseif(!$ticap->election_has_started){
                session()->flash('error', 'Appoint officers first.');
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

    // SLIDER
    public function HomeSlider(){
        $sliders = Slider::all();
        return view('slider.index', compact('sliders'));
    }

    public function AddSlider(){
        return view('slider.add-slider');
    }

    public function StoreSlider(Request $request){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,bmp,png',
        ]);

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
        $streams = Stream::all();
        return view('stream.index', compact('streams'));
    }

    public function AddStream(){
        return view('stream.add-stream');
    }

    public function StoreStream(Request $request){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'stream' => 'required',
        ]);

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

    public function HomeBrand(){
        $brands = Brand::all();
        return view('brand.index', compact('brands'));
    }

    public function AddBrand(){
        return view('brand.add-brand');
    }

    public function StoreBrand(Request $request){

        $request->validate([
            'image' => 'required|mimes:jpg,bmp,png',
        ]);

        $image = $request->file('image');

        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('image/brand'.$name_gen);

        $last_img = 'image/brand'.$name_gen;

        Brand::insert([
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

           return redirect()->route('home.brand');
    }

    public function deleteBrand($id){
        $image = Brand::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Brand::find($id)->delete();
        return redirect()->route('home.brand');
    }

}
