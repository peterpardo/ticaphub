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
        $user = User::find(Auth::user()->id);
        $title = 'User Accounts';
        $scripts = [
            asset('js/useraccounts/setInvitation.js'),
        ];

        return view('user-accounts.set-invitation', [
            'title' => $title,
            'scripts' => $scripts,
        ]);
    }

    // Add panelist form
    public function panelistForm() {
        $title = 'User Accounts';
        $schools = School::all();
        return view('user-accounts.add-panelist', [
            'title' => $title,
            'schools' => $schools,
        ]);
    }

    public function addPanelist(Request $request) {
        // Get ticap id of current admin
        $ticap = Auth::user()->ticap_id;

        $request->validate([
            'first_name' => 'required|max:30',
            'middle_name' => 'nullable|string|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email|unique:users,email',
        ]);

        // Generate default panelist password Ex. panelist123
        $tempPassword = "panelist123";

        // Add panelist
        $user = User::create([
            'first_name' => Str::title($request->first_name),
            'middle_name' => Str::title($request->middle_name),
            'last_name' => Str::title($request->last_name),
            'email' => $request->email,
            'password' => $tempPassword,
            'ticap_id' => $ticap,
        ]);

        // Assign user as panelist
        $user->assignRole('panelist');

        // Send link for password change
        // Link is valid for 5 days once sent to the admin
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

    // Add admin to ticap
    public function adminForm() {
        $title = 'User Accounts';
        $schools = School::all();

        return view('user-accounts.add-admin', [
            'title' => $title,
            'schools' => $schools,
        ]);
    }

    public function addAdmin(Request $request) {
        // Get ticap id of current admin
        $ticap = Auth::user()->ticap_id;

        $request->validate([
            'first_name' => 'required|max:30',
            'middle_name' => 'nullable|string|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email|unique:users,email',
        ]);

        // Generate default admin password Ex. admin123
        $tempPassword = "admin123";

        // Add admin
        $user = User::create([
            'first_name' => Str::title($request->first_name),
            'middle_name' => Str::title($request->middle_name),
            'last_name' => Str::title($request->last_name),
            'email' => $request->email,
            'password' => $tempPassword,
            'ticap_id' => $ticap,
        ]);

        // Assign user as admin
        $user->assignRole('admin');

        // Send link for password change
        // Link is valid for 5 days once sent to the admin
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

    // Add students to ticap
    public function userForm() {
        $title = 'User Accounts';

        return view('user-accounts.add-student', [
            'title' => $title,
        ]);
    }

    public function setPasswordForm(Request $request) {
        // Check if token exists in the registered table
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
            'password' => 'required|confirmed|min:6',
        ]);

        // Check if email and token exists
        $user = DB::table('register_users')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->exists();

        // Throw error if user doesn't exists
        if(!$user){
            return back()->with('error', 'Current doesn\'t match the expected account.');
        }

        // Delete registered token
        DB::table('register_users')->where('token', $request->token)->delete();

        // Verify email of user
        $user = User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
            'email_verified' => 1,
        ]);

        return redirect()->route('login')->with('status', 'Password has been saved');
    }

    public function downloadImportStudentsExample() {
        return response()->download(asset("example.csv"));
    }

    public function importUsers() {
        $title = 'User Accounts';
        $schools = School::where('is_involved', 1)->get();
        $scripts = [
            asset('js/useraccounts/importStudents.js')
        ];

        return view('user-accounts.upload-student', [
            'title' => $title,
            'schools' => $schools,
            'scripts' => $scripts
        ]);
    }

    public function getSpecializations(Request $request) {
        // Check if school id is not null
        if($request->schoolId != "") {
            $specs = Specialization::where('school_id', $request->schoolId)->get();
            return $specs;
        }
    }

    public function importFile(Request $request) {

        // Rollbacks all inserted students if a signle field is missing
        return DB::transaction(function() use ($request){
            // File type must be CSV
            if($request->file) {
                if($request->file->getClientOriginalExtension() != 'csv') {
                    throw new GeneralException('File must be in csv format');
                }
            }

            // Validate input fields
            $request->validate([
                'school' => 'required',
                'specialization' => 'required',
                'file' => 'required',
            ]);

            $file = $request->file;
            $specialization = $request->specialization;
            // Read file
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

                    // Checks if each cell is filled out
                    foreach($fields as $key => $value) {
                        // Exclude middle name of student as required
                        if($key != "middle_name" && $value == "") {
                            $newKey = str_replace('_', ' ', $key);
                            throw new GeneralException('Line ' . $ctr . ' - ' . $newKey . ' is missing.');
                        }
                    }

                    // Generate default password Ex. picab201811780
                    $tempPassword = "picab" . $fields['id_number'];

                    // Check if email and student number is unique
                    if(User::where('email', $fields['email'])->exists()){
                        throw new GeneralException('Line ' . $ctr . ' - Email must be unique');
                    } else if (User::where('email', $fields['id_number'])->exists()) {
                        throw new GeneralException('Line ' . $ctr . ' - Student number must be unique');
                    }

                    // Create student account
                    $ticap = Auth::user()->ticap_id;
                    $user = User::create([
                        'first_name' => Str::title($fields['first_name']),
                        'middle_name' => Str::title($fields['middle_name']),
                        'last_name' => Str::title($fields['last_name']),
                        'password' => Hash::make($tempPassword),
                        'email' => $fields['email'],
                        'ticap_id' => $ticap,
                    ]);

                    // Assign users as student
                    $user->assignRole('student');

                    // Add student to their respective specialization
                    $user->userSpecialization()->create([
                        'specialization_id' => $specialization,
                        'id_number' => $fields['id_number'],
                    ]);

                    // Assign student which election to vote for
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

                    // Check if the capstone group exists in the database
                    $groupName = Str::upper($fields['group']);
                    if(!Group::where('name', $groupName)->exists()) {
                        // Create new group
                        $group = Group::create([
                            'name' => $groupName,
                            'specialization_id' => $specialization,
                            'ticap_id' => $ticap,
                        ]);

                        // Create new group exhibit
                        if(!$group->groupExhibit()->exists()) {
                            $group->groupExhibit()->create([
                                'ticap_id' => $ticap,
                            ]);
                        }
                        $user->userGroup()->create([
                            'group_id' => $group->id,
                        ]);
                    } else {
                        // Assign the student to the existing group
                        $group = Group::where('name', $groupName)->first();
                        $user->userGroup()->create([
                            'group_id' => $group->id,
                        ]);
                    }

                    // Send invitation email to the student
                    // Email contains link to set their password
                    $token = Str::random(60) . time();
                    $link = URL::temporarySignedRoute('set-password', now()->addDays(5), [
                        'token' => $token,
                        'ticap' => Auth::user()->ticap_id,
                        'email' => $fields['email'],
                    ]);
                    $details = [
                        'title' => 'Welcome to TICaP Hub ' . $fields['email'],
                        'body' => "You are invited! Click the link below",
                        'link' => $link,
                    ];

                    // Insert email as a registered email in the system
                    DB::table('register_users')->insert([
                        'email' => $fields['email'],
                        'token' => $token,
                        'created_at' =>  date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                    // Dispatch job for sending the email
                    dispatch(new RegisterUserJob($fields['email'], $details));

                    // Increment ctr to proceed to next student
                    $ctr++;
                }
                fclose($handle);
            }

            $request->session()->flash('message', 'Users have been added. Invitation Emails will be sent.');
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
