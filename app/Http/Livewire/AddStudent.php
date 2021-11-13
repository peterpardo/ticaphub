<?php

namespace App\Http\Livewire;

use App\Jobs\RegisterUserJob;
use App\Models\Election;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AddStudent extends Component
{
    public $first_name;
    public $middle_name;
    public $last_name;
    public $id_number;
    public $email;
    public $selectedSpec = null;
    public $selectedSchool = null;
    public $specializations = null;
    public $groups = null;
    public $selectedGroup;
    protected $rules = [
        'id_number' => 'required|numeric|max:99999999999',
        'first_name' => 'required',
        'middle_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email',
        'selectedSchool' => 'required',
        'selectedSpec' => 'required',
        'selectedGroup' => 'required',
    ];
    protected $messages = [
        'selectedSchool.required' => 'The school field is required',
        'selectedSpec.required' => 'The specialization field is required',
        'selectedGroup.required' => 'The group field is required',
    ];

    public function render()
    {
        $schools = School::where('is_involved', 1)->get();
        return view('livewire.add-student', [
            'schools' => $schools,
        ]);
    }
    public function insertGroup($group) {
        $this->selectedGroup = $group;
    }
    public function updatedSelectedSchool($schoolId){
        $this->selectedSpec = null;
        $this->specializations = Specialization::where('school_id', $schoolId)->get();
    }
    public function updatedSelectedSpec($specId){
        $this->groups = Group::where('specialization_id', $specId)->get();
    }
    public function addStudent() {
        $this->validate();
        
        $ticap = Auth::user()->ticap_id;
        // GENERATE DEFAULT PASSWORD
        $tempPassword = "picab" . $this->id_number;
        $user = User::create([
            'first_name' => Str::title($this->first_name),
            'middle_name' => Str::title($this->middle_name),
            'last_name' => Str::title($this->last_name),
            'password' => Hash::make($tempPassword),
            'email' => $this->email,
            'ticap_id' => $ticap,
        ]);
        $user->assignRole('student');
        $user->userSpecialization()->create([
            'specialization_id' => $this->selectedSpec,
            'id_number' => $this->id_number,
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
        // CHECK IF GROUP ALREADY EXIST
        $groupName = Str::upper(trim($this->selectedGroup));
        if(!Group::where('name', $groupName)
        ->where('specialization_id', $this->selectedSpec)
        ->exists()) {
            // CREATE GROUP
            $group = Group::create([
                'name' => $groupName,
                'specialization_id' => $this->selectedSchool,
                'ticap_id' => $ticap,
            ]);
            $user->userGroup()->create([
                'group_id' => $group->id,
            ]);
        } else {
            // ADD USER TO EXISTING GROUP
            $group = Group::where('name', $groupName)
            ->where('specialization_id', $this->selectedSpec)
            ->first();
            $user->userGroup()->create([
                'group_id' => $group->id,
            ]);
        };
        // CREATE GROUP EXHIBIT FOR THE GROUP
        if(!$user->userGroup->group->groupExhibit()->exists()) {
            $user->userGroup->group->groupExhibit()->create([
                'ticap_id' => $ticap,
            ]);
        }
        // SEND LINK FOR CHANGING PASSWORD TO USER
        $token = Str::random(60) . time();
        $link = URL::temporarySignedRoute('set-password', now()->addDays(5), [
            'token' => $token, 
            'ticap' => $ticap,
            'email' => $this->email,
        ]);
        $details = [
            'title' => 'Welcome to TICaP Hub ' . $this->email,
            'body' => "You are invited! Click the link below",
            'link' => $link,
        ];
        DB::table('register_users')->insert([
            'email' => $this->email,
            'token' => $token,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        dispatch(new RegisterUserJob($this->email, $details));
        session()->flash('status', 'green');
        session()->flash('message', 'Invitation has been sent successfully');
        $this->resetValidation();
        $this->reset();
    }
}
