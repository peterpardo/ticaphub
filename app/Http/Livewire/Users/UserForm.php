<?php

namespace App\Http\Livewire\Users;

use App\Jobs\RegisterUserJob;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use App\Models\UserElection;
use App\Models\UserSpecialization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;

class UserForm extends Component
{
    public $showForm = false;

    // User info
    public $fname;
    public $lname;
    public $email;
    public $role = '';
    public $showStudentFields = false;

    // Students info only
    public $selectedSchool = 1;
    public $specializations = [];
    public $selectedSpecialization = '';

    public $groups = [];
    public $selectedGroup = "";

    // Action (add or update)
    public $action = 'add';
    public $userId;

    protected $listeners = ['getUser', 'showForm'];

    public $userRules = [
        'email' => 'required|email',
        'fname' => 'required|max:30',
        'lname' => 'required|max:30',
        'role' => 'required'
    ];

    public $studentRules = [
        'selectedSchool' => 'required',
        'selectedSpecialization' => 'required',
        'selectedGroup' => 'required',
    ];

    public $userRuleAttributes = [
        'email' => 'Email',
        'fname' => 'First Name',
        'lname' => 'Last Name',
    ];

    public $studentRuleAttributes = [
        'selectedSchool' => 'School',
        'selectedSpecialization' => 'Specialization',
        'selectedGroup' => 'Group',
    ];


    public function mount() {
        $this->specializations = Specialization::where('school_id', $this->selectedSchool)->get();
    }

    public function getUser($userId) {
        // Retrieve data of selected user
        $user = User::find($userId);
        $this->userId = $user->id;

        $this->fname = $user->first_name;
        $this->lname = $user->last_name;
        $this->email = $user->email;

        // Check role of selected user
        if ($user->hasRole('panelist')) {
            $this->role = 'panelist';
        } else if ($user->hasRole('admin')){
            $this->role = 'admin';
        } else {
            $studentInfo = UserSpecialization::where('user_id', $user->id)->with('specialization')->first();
            $this->role = 'student';
            $this->showStudentFields = true;

            // Retrieve student info
            $this->selectedSchool = $studentInfo->specialization->school_id;

            // Update specialization list based on selected school
            $this->selectedSpecialization = $studentInfo->specialization_id;
            $this->specializations = Specialization::where('school_id', $this->selectedSchool)->get();

            // Update group list based on selected specialization
            $this->selectedGroup = $studentInfo->group_id;
            $this->groups = Group::select('id', 'name')->where('specialization_id', $this->selectedSpecialization)->get();
        }

        // Set action as updating
        $this->action = 'update';
        $this->showForm = true;
    }

    public function showForm() {
        $this->showForm = true;
        $this->resetInputFields();
    }

    public function resetInputFields() {
        $this->reset('role', 'fname', 'lname', 'email', 'selectedSchool', 'selectedSpecialization', 'selectedGroup', 'showStudentFields', 'action');
        $this->specializations = Specialization::where('school_id', $this->selectedSchool)->get();
    }

    public function closeModal() {
        $this->showForm = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function updatedRole($value) {
        // Check if show the student fields
        if ($value !== 'student') {
            $this->showStudentFields = false;
        } else {
            $this->showStudentFields = true;
        }

        // Remove validation errors
        $this->resetValidation();

        $this->reset('selectedSchool', 'selectedSpecialization', 'selectedGroup');
    }

    // Update values of specializations and groups based on the school
    public function updatedSelectedSchool() {
        $this->specializations = Specialization::where('school_id', $this->selectedSchool)->get();

        $this->reset('selectedSpecialization', 'selectedGroup', 'groups');
    }

    public function updatedSelectedSpecialization() {
        $this->groups = Group::where('specialization_id', $this->selectedSpecialization)->get(['id', 'name']);

        $this->reset('selectedGroup');
    }

    // Add new group
    // public function addGroup() {
    //     // Specialization and Adviser must be selected before creating a Group
    //     if ($this->selectedSpecialization == ''){
    //        $this->addError('newGroup', 'Please select a specialization first.');
    //        return;
    //     }
    //     $this->validate([
    //         'newGroup' => 'required|string',
    //     ], [], [
    //         'newGroup' => 'Group'
    //     ]);

    //     // Check if name is unique
    //     $formattedName = Str::title($this->newGroup);
    //     $nameExists = Group::where('name', '=', $formattedName)->exists();
    //     if ($nameExists) {
    //         $this->addError('newGroup', 'The New Group Name must be unique.');
    //         return;
    //     };

    //     // Add group
    //     Group::create([
    //         'name' => $this->newGroup,
    //         'specialization_id' => $this->selectedSpecialization,
    //         'ticap_id' => auth()->user()->ticap_id,
    //     ]);

    //     // Update groups select field
    //     $this->groups = Group::select('id', 'name')->where('specialization_id', $this->selectedSpecialization)->get();

    //     // Empty input field
    //     $this->reset('newGroup', 'selectedGroup');
    // }

    public function saveUser() {
        // Validation for all user roles
        $validations = $this->userRules;
        $attributes = $this->userRuleAttributes;

        // Check if user role is student
        if ($this->showStudentFields) {
            $validations = array_merge($this->userRules, $this->studentRules);
            $attributes = array_merge($this->userRuleAttributes, $this->studentRuleAttributes);
        }

        // Validation
        $validated = $this->validate($validations, [], $attributes);
        // dd($validated);

        // Add user
        if ($this->action == 'update') {
            $user = User::find($this->userId);

            // Check if the email is changed
            if ($user->email !== $this->email) {
                $this->validate([
                    'email' => 'unique:users,email'
                ]);
            }

            // Update user info
            $user->first_name = Str::title($this->fname);
            $user->last_name = Str::title($this->lname);
            $user->email = $this->email;
            $user->save();

            // Remove previous roles
            $user->syncRoles([]);
        } else {
            $this->validate([
                'email' => 'unique:users,email'
            ]);

            // Add user
            $user = User::create([
                'first_name' => trim(Str::title($this->fname)),
                'last_name' => trim(Str::title($this->lname)),
                'password' => trim(Hash::make('ticaphub123')), // default password
                'email' => $this->email,
                'ticap_id' => auth()->user()->ticap_id,
            ]);

            // TODO: Send email to user for resetting of password
            // Link is valid for 5 days once sent to the student
            $token = Str::random(60) . time();
            $link = URL::temporarySignedRoute('set-password', now()->addDays(5), [
                'token' => $token,
                'ticap' => auth()->user()->ticap_id,
                'email' => $this->email,
            ]);
            $details = [
                'title' => 'Welcome to TICAPHUB, ' . $user->first_name . '!',
                'body' => 'Click the link to confirm your email.',
                'link' => $link,
            ];
            DB::table('register_users')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' =>  now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
            RegisterUserJob::dispatch($this->email, $details);
        }

        // Add roles
        if ($this->role === 'panelist') {
            $user->assignRole('panelist');
        } else if ($this->role === 'admin') {
            $user->assignRole('admin');
        } else {
            $user->assignRole('student');

            if ($this->action == 'update') {
                // Update student specialization and group
                $user->userSpecialization()->update([
                    'specialization_id' => $this->selectedSpecialization,
                    'group_id' => $this->selectedGroup
                ]);

                // Update user which election to vote
                $electionId = Specialization::select('election_id')->where('id', $this->selectedSpecialization)->pluck('election_id')->first();
                $user->userElection()->update([
                    'election_id' => $electionId,
                ]);
            } else {
                $user->userSpecialization()->create([
                    'specialization_id' => $this->selectedSpecialization,
                    'group_id' => $this->selectedGroup
                ]);

                // Assign user which election to vote
                $electionId = Specialization::select('election_id')->where('id', $this->selectedSpecialization)->pluck('election_id')->first();
                UserElection::insert([
                    'user_id' => $user->id,
                    'election_id' => $electionId,
                    'has_voted' => 0,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ]);
            }
        }

        // Refresh parent component and return success message
        $this->emit('refreshParent', $this->action);

        // Close modal
        $this->showForm = false;

        // Reset input fields
        $this->resetInputFields();
    }

    public function render()
    {
        return view('livewire.users.user-form', [
            'schools' => School::where('is_involved', 1)->get(),
        ]);
    }
}
