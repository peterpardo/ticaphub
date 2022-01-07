<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralException;
use App\Jobs\RegisterUserJob;
use App\Models\Election;
use App\Models\Event;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\Ticap;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{   
    public function invitationForm() {
        $user = User::find(1);
        $ticap = Ticap::find($user->ticap_id);
        if($ticap->invitation_is_set) {
            return redirect()->route('users');
        }
        $title = 'User Accounts';
        $scripts = [
            asset('js/useraccounts/setInvitation.js'),
        ];
        return view('user-accounts.set-invitation', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }

    public function setInvitation(Request $request) {
        $request->validate([
            'FEU_Diliman' => 'numeric',
            'FEU_Alabang' => 'numeric',
        ]);
        if($request->FEU_Diliman != null) {
            $school = School::find($request->FEU_Diliman);
            $school->is_involved = 1;
            $school->save();
        } 
        if($request->FEU_Alabang != null) {
            $school = School::find($request->FEU_Alabang);
            $school->is_involved = 1;
            $school->save();
        } 
        $ticap = Ticap::find(Auth::user()->ticap_id);
        $ticap->invitation_is_set = 1;
        $ticap->save();
        return redirect()->route('users');
    }

    public function fetchSpecializations(){
        $specializations = Specialization::all();
        return response()->json([
            'specializations' =>  $specializations,
        ]);
    }

    public function addSpecialization(Request $request) {
        $validator = Validator::make($request->all(), [
            'specialization' => 'required|unique:specializations,name',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            Specialization::create([
                'name' => Str::title($request->specialization)
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Specialization Added SuccessFully',
            ]);
        }
    }

    public function deleteSpecialization(Request $request) {
        $validator = Validator::make($request->all(), [
            'specialization_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            Specialization::find($request->specialization_id)->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Specialization Deleted SuccessFully',
            ]);
        }
    }

    // ADD PANELISTS FOR USERS ACCOUNT
    public function panelistForm() {
        $title = 'User Accounts';
        $schools = School::all();
        return view('user-accounts.add-panelist', [
            'title' => $title,
            'schools' => $schools,
        ]);
    }

    public function addPanelist(Request $request) {
        $ticap = Auth::user()->ticap_id;
        // VALIDATION OF INPUT
        $request->validate([
            'first_name' => 'required',
            'middle_name' => 'string',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]); 
        // GENERATE DEFAULT PASSWORD
        $tempPassword = "panelist123";
         // CREATE USER
        $user = User::create([
            'first_name' => Str::title($request->first_name),
            'middle_name' => Str::title($request->middle_name),
            'last_name' => Str::title($request->last_name),
            'email' => $request->email,
            'password' => $tempPassword,
            'ticap_id' => $ticap,
        ]);
        // ASSIGN PANELIST ROLE
        $user->assignRole('panelist');
       // SEND LINK FOR CHANGING PASSWORD TO USER
        $token = Str::random(60) . time();
        $link = URL::temporarySignedRoute('set-password', now()->addDays(5), [
            'token' => $token, 
            'ticap' => $ticap,
            'email' => $request->email,
        ]);
        $details = [
            'title' => 'Welcome to TICaP Hub ' . $request->email,
            'body' => "You are invited! Click the link below",
            'link' => $link,
        ];
        DB::table('register_users')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        dispatch(new RegisterUserJob($request->email, $details));
        $request->session()->flash('message', 'Invitation has been sent successfully');
        $request->session()->flash('status', 'green');
        return back();
    }

    // ADD ADMIN FOR USER ACCOUNTS
    public function adminForm() {
        $title = 'User Accounts';
        $schools = School::all();
        return view('user-accounts.add-admin', [
            'title' => $title,
            'schools' => $schools,
        ]);
    }

    public function addAdmin(Request $request) {
        $ticap = Auth::user()->ticap_id;
        // VALIDATION OF INPUT
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]); 
        if($request->middle_name) {
            $request->validate(['middle_name' => 'string']);
        }
        // GENERATE DEFAULT PASSWORD
        $tempPassword = "admin123";
         // CREATE USER
        $user = User::create([
            'first_name' => Str::title($request->first_name),
            'middle_name' => Str::title($request->middle_name),
            'last_name' => Str::title($request->last_name),
            'email' => $request->email,
            'password' => $tempPassword,
            'ticap_id' => $ticap,
        ]);
        // ASSIGN ADMIN ROLE
        $user->assignRole('admin');
       // SEND LINK FOR CHANGING PASSWORD TO USER
        $token = Str::random(60) . time();
        $link = URL::temporarySignedRoute('set-password', now()->addDays(5), [
            'token' => $token, 
            'ticap' => $ticap,
            'email' => $request->email,
        ]);
        $details = [
            'title' => 'Welcome to TICaP Hub ' . $request->email,
            'body' => "You are invited! Click the link below",
            'link' => $link,
        ];
        DB::table('register_users')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        dispatch(new RegisterUserJob($request->email, $details));
        $request->session()->flash('message', 'Invitation has been sent successfully');
        $request->session()->flash('status', 'green');
        return back();
    }

    // ADD ADMIN FOR USER(STUDENTS) ACCOUNTS
    public function userForm() {
        $title = 'User Accounts';

        return view('user-accounts.add-student', [
            'title' => $title,
        ]);
    }

    public function setPasswordForm(Request $request) {
        $isInvited = true;
        if(!DB::table('register_users')->where('token', $request->token)->exists()){
            $isInvited = false;
        }
        return view('user-accounts.set-password', [
            'token' => $request->token,
            'ticap' => $request->ticap,
            'email' => $request->email,
            'isInvited' => $isInvited,
        ]);
    }

    public function setPassword(Request $request) {
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        // CHECK IF EMAIL AND TOKEN EXISTS
        $user = DB::table('register_users')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->exists();
        if(!$user){
            return back()->with('error', 'Current doesn\'t match the expected account.');
        } 
        // DELETE REGISTER TOKEN
        DB::table('register_users')->where('token', $request->token)->delete();
        // UPDATE USER 
        $user = User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
            'email_verified' => 1,
        ]);
        return redirect()->route('login');
    }

    public function importUsers() {
        $title = 'User Accounts';
        return view('user-accounts.upload-student', [
            'title' => $title,
        ]);
    }

    public function importFile(Request $request) {
        return DB::transaction(function() use ($request){
            if($request->file) {
                if($request->file->getClientOriginalExtension() != 'csv') {
                    throw new GeneralException('File must be in csv format'); 
                }
            }

            $request->validate([
                'school' => 'required',
                'specialization' => 'required',
                'file' => 'required',
            ]);

            $file = $request->file;
            $specialization = $request->specialization;
             // READ FILE
            $ctr = 1;
            if (($handle = fopen($file, "r")) !== FALSE) {
                while (($row = fgetcsv($handle, 1000)) !== FALSE) {
                    if($ctr == 1){
                        $ctr++;
                        continue;
                    }
                    // HEADERS
                    $fields = [];
                    $fields['first_name'] = trim($row[0]);
                    $fields['middle_name'] = trim($row[1]);
                    $fields['last_name'] = trim($row[2]);
                    $fields['email'] = trim($row[3]);
                    $fields['id_number'] = trim($row[4]);
                    $fields['group'] = trim($row[5]);
                    foreach($fields as $key => $value) {
                        if($key == "middle_name") {
                            continue;
                        }
                        if($value == null || $value == "") {
                            throw new GeneralException('Line ' . $ctr . ' - ' . $key . ' is missing.'); 
                        }
                    }
                    // GENERATE RANDOM PASSWORD
                    $tempPassword = "picab" . $fields['email'];
                    // VALIDATE EMAIL AND STUDENT NUMBER
                    if(User::where('email', $fields['email'])->exists() ){     
                        throw new GeneralException('Line ' . $ctr . ' - Email must be unique'); 
                    }
                    // CREATE USER
                    $ticap = Auth::user()->ticap_id;
                    $user = User::create([
                        'first_name' => Str::title($fields['first_name']),
                        'middle_name' => Str::title($fields['middle_name']),
                        'last_name' => Str::title($fields['last_name']),
                        'password' => Hash::make($tempPassword),
                        'email' => $fields['email'],
                        'ticap_id' => $ticap,
                    ]);
                    // ASSIGN STUDENT ROLE
                    $user->assignRole('student');
                    // ADD STUDENT WITH SPECIALIZATION
                    $user->userSpecialization()->create([
                        'specialization_id' => $specialization,
                        'id_number' => $fields['id_number'],
                    ]);
                    // ASSIGN STUDENT WHICH ELECTION TO VOTE
                    if($user->userSpecialization->specialization->school->id == 1) {
                        $spec = Specialization::find($user->userSpecialization->specialization->id);
                        $spec->election->userElections()->create([
                            'user_id' => $user->id,
                        ]);
                    } else {
                        if($user->userSpecialization->specialization->school->name == 'FEU DILIMAN') {
                            $election = Election::with(['candidates'])->where('name', 'FEU DILIMAN')->first();
                            $election->userElections()->create([
                                'user_id' => $user->id,
                            ]);
                        } elseif($user->userSpecialization->specialization->school->name == 'FEU ALABANG') {
                            $election = Election::with(['candidates'])->where('name', 'FEU ALABANG')->first();
                            $election->userElections()->create([
                                'user_id' => $user->id,
                            ]);
                        }
                    }
                    // CHECK IF GROUP EXISTS
                    $groupName = Str::upper($fields['group']);
                    if(!Group::where('name', $groupName)->exists()) {
                        $group = Group::create([
                            'name' => $groupName,
                            'specialization_id' => $specialization,
                            'ticap_id' => $ticap,
                        ]);
                        // CREATE DEFAULT GROUP EXHIBIT
                        if(!$group->groupExhibit()->exists()) {
                            $group->groupExhibit()->create([
                                'ticap_id' => $ticap,
                            ]);
                        }
                        $user->userGroup()->create([
                            'group_id' => $group->id,
                        ]);
                    } else {
                        $group = Group::where('name', $groupName)->first();
                        $user->userGroup()->create([
                            'group_id' => $group->id,
                        ]);
                    }
                    // CREATE GROUP EXHIBIT FOR THE GROUP
                    if(!$user->userGroup->group->groupExhibit()->exists()) {
                        $user->userGroup->group->groupExhibit()->create([
                            'ticap_id' => $ticap,
                        ]);
                    }
                    $ctr++;
                }
                fclose($handle);
            }
            // SEND EMAILS
            $ctr = 1;
            if (($handle = fopen($file, "r")) !== FALSE) {
                while (($row = fgetcsv($handle, 1000)) !== FALSE) {
                    if($ctr == 1){
                        $ctr++;
                        continue;
                    }
                    // GET EMAIL
                    $email = trim($row[3]);
                    // SEND LINK FOR CHANGING PASSWORD TO USER
                    $token = Str::random(60) . time();
                    $link = URL::temporarySignedRoute('set-password', now()->addDays(5), [
                        'token' => $token, 
                        'ticap' => Auth::user()->ticap_id,
                        'email' => $email,
                    ]);
                    $details = [
                        'title' => 'Welcome to TICaP Hub ' . $email,
                        'body' => "You are invited! Click the link below",
                        'link' => $link,
                    ];
                    DB::table('register_users')->insert([
                        'email' => $email,
                        'token' => $token,
                        'created_at' =>  date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    // RegisterUserJob::dispatch($email, $details)
                    //     ->delay(now()->addMinutes(1));
                    // // dispatch(new RegisterUserJob($email, $details))->delay(now()->addMinutes(1));
                    dispatch(new RegisterUserJob($email, $details));
                }
            }
            $request->session()->flash('message', 'Email has been sent successfully');
            $request->session()->flash('status', 'green');
            return back();
        });
    }
    public function editUserForm($userId) {
        $title = 'User Accounts';
        $user = User::find($userId);
        $scripts = [
            asset('js/useraccounts/editUser.js'),
        ];
        return view('user-accounts.edit-user', [
            'title' => $title,
            'user' => $user,
            'scripts' => $scripts,
        ]);
    }
    public function editUser(Request $request, $userId) {
        $request->validate([
            'first_name' => 'required|string|max:30',
            'middle_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'group' => 'required',
        ]);
        $user = User::find($userId);
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->save();
        $user->userGroup->group_id = $request->group;
        $user->userGroup->save();
        return redirect()->route('users');
    }

    public function editProfile(){
        $user = User::find(Auth::user()->id);
        $scripts = [
            asset('js/useraccounts/user-profile.js'),
        ];

        return view('user-accounts.update-user', [
            'user' => $user,
            'scripts' => $scripts
        ]);
    }

    public function updateProfile(Request $request){
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);

        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        if($request->middle_name != " ") {
            dd('sop');
            $request->validate([
                'middle_name' => 'string',
            ]);
            $user->middle_name = $request->middle_name;
        }
        $user->last_name = $request->last_name;
        $user->save();

        return Redirect()->back()->with('success','User Profile is updated sucessfully!');
    }

    public function groups() {
        $groups = Group::with(['specialization.school'])->get();
        $title = 'User Accounts';

        return view('user-accounts.groups', [
            'groups' => $groups,
            'title' => $title,
        ]);
    }

    public function viewGroup($id) {
        $group = Group::find($id);
        $title = 'User Accounts';

        return view('user-accounts.view-group', [
            'group' => $group,
            'title' => $title,
        ]);
    }
}
