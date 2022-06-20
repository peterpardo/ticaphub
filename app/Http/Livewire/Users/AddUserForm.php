<?php

namespace App\Http\Livewire\Users;

use App\Models\Election;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
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
    public $isStudent = true;
    public $role = 'student';
    public $showStudentFields = true;

    // Students info only
    public $idNumber;
    public $selectedSchool = 1;
    public $specializations = [];
    public $selectedSpecialization = "";
    public $groups = [];
    public $selectedGroup = "";
    public $advisers = [];
    public $selectedAdviser;

    public $userRules = [
        'email' => 'required|email|unique:users,email',
        'fname' => 'required|max:30',
        'lname' => 'required|max:30',
    ];

    public $studentRules = [
        'selectedSchool' => 'required',
        'selectedSpecialization' => 'required',
        'selectedGroup' => 'required',
        'selectedAdviser' => 'required',
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
        'selectedAdviser' => 'Adviser',
    ];


    public function mount() {
        $this->specializations = Specialization::where('school_id', $this->selectedSchool)->get();
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
    }

    public function closeModal() {
        // Remove validations if there's any
        $this->resetValidation();

        $this->emit('refreshParent');
    }

    // Update values of specializations and groups based on the school
    public function updatedSelectedSchool() {
        $this->specializations = Specialization::where('school_id', $this->selectedSchool)->get();

        $this->reset('selectedSpecialization');
        $this->reset('selectedGroup');
    }

    public function updatedSelectedSpecialization() {
        $this->groups = Group::where('specialization_id', $this->selectedSpecialization)->get(['id', 'name']);
    }

    public function addUser() {
        dd(Election::select('id')->where('specialization_id', $this->selectedSpecialization)->get());

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

        // Add user
        $user = User::create([
            'first_name' => Str::title($this->first_name),
            'last_name' => Str::title($this->last_name),
            'password' => Hash::make('ticaphub123'),
            'email' => $this->email,
            'ticap_id' => auth()->user()->ticap_id,
        ]);

        // Add roles
        if ($this->role === 'panelist') {
            $user->assignRole('panelist');
        } else if ($this->role === 'admin') {
            $user->assignRole('admin');
        } else {
            $user->assignRole('student');

            // Set student specialization and group
            $user->userSpecialization()->create([
                'specialization_id' => $this->selectedSpecialization,
                'group_id' => $this->selectedGroup
            ]);

            // Assign user which electiom to vote
            if ($this->selectedSchool == 1) {
                $electionId = Election::select('id')->where('specialization_id', $this->selectedSpecialization)->get();
                UserSpecialization::insert([
                    'user_id' => $user->id,
                    'election_id' => $$electionId,
                    'has_voted' => 0,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ]);
            }
        }

    }

    public function render()
    {
        return view('livewire.users.add-user-form', [
            'schools' => School::where('is_involved', 1)->get(),
        ]);
    }
}
