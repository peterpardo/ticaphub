<?php

namespace App\Http\Livewire\Users;

use App\Models\Adviser;
use App\Models\Election;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use App\Models\UserElection;
use App\Models\UserSpecialization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class AddUserForm extends Component
{
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
    public $newGroup;
    public $selectedGroup = "";
    public $groupStatus = false;

    // Action (add or update)
    public $action;
    public $userId;

    protected $listeners = ['getUser'];

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

    public function closeModal() {
        // Remove validations if there's any
        $this->reset('fname', 'lname', 'email', 'role', 'showStudentFields', 'selectedSpecialization', 'selectedGroup', 'newGroup', 'action');
        $this->resetValidation();

        $this->emit('refreshParent');
    }

    // Update values of specializations and groups based on the school
    public function updatedSelectedSchool() {
        $this->specializations = Specialization::where('school_id', $this->selectedSchool)->get();

        $this->reset('selectedSpecialization', 'groupStatus');
        $this->reset('selectedGroup', 'newGroup');
    }

    public function updatedSelectedSpecialization() {
        $this->groups = Group::where('specialization_id', $this->selectedSpecialization)->get(['id', 'name']);

        $this->reset('selectedGroup', 'newGroup');
    }

    public function updatedSelectedGroup() {
        $this->reset('groupStatus');
    }

    // Add new group
    public function addGroup() {
        // Specialization and Adviser must be selected before creating a Group
        if ($this->selectedSpecialization == ''){
           $this->addError('newGroup', 'Please select a specialization first.');
           return;
        }
        $this->validate([
            'newGroup' => 'required|string',
        ], [], [
            'newGroup' => 'Group'
        ]);

        // Check if name is unique
        $formattedName = Str::title($this->newGroup);
        $nameExists = Group::where('name', '=', $formattedName)->exists();
        if ($nameExists) {
            $this->addError('newGroup', 'The New Group Name must be unique.');
            return;
        };

        // Add group
        Group::create([
            'name' => $this->newGroup,
            'specialization_id' => $this->selectedSpecialization,
            'ticap_id' => auth()->user()->ticap_id,
        ]);

        // Show flash message
        $this->groupStatus = true;

        // Update groups select field
        $this->groups = Group::select('id', 'name')->where('specialization_id', $this->selectedSpecialization)->get();

        // Empty input field
        $this->reset('newGroup', 'selectedGroup');
    }

    public function addUser() {
        // Validation for all user roles
        $validations = $this->userRules;
        $attributes = $this->userRuleAttributes;

        // Check if user role is student
        if ($this->showStudentFields) {
            $validations = array_merge($this->userRules, $this->studentRules);
            $attributes = array_merge($this->userRuleAttributes, $this->studentRuleAttributes);
        }

        // Validation
        $this->validate($validations, [], $attributes);

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
            $user = User::create([
                'first_name' => Str::title($this->fname),
                'last_name' => Str::title($this->lname),
                'password' => Hash::make('ticaphub123'), // default password
                'email' => $this->email,
                'ticap_id' => auth()->user()->ticap_id,
            ]);
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

        // TODO: Send email to user for resetting of password

        // Refresh parent component and return success message
        $this->emit('refreshParent', 'success');

        // Reset input fields
        $this->reset('fname', 'lname', 'email', 'role', 'showStudentFields', 'selectedSpecialization', 'selectedGroup', 'newGroup', 'action');
    }

    public function render()
    {
        return view('livewire.users.add-user-form', [
            'schools' => School::where('is_involved', 1)->get(),
            'groups' => Group::select('id', 'name')->where('specialization_id', $this->selectedSpecialization)->get()
        ]);
    }
}