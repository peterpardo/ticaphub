<?php

namespace App\Http\Livewire\Users;

use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class ViewUser extends Component
{
    public User $user;
    public $showStudentFields = false;
    public $schools;
    public $specializations = [];
    public $groups = [];
    public $selectedSchool;
    public $selectedSpecialization = '';
    public $selectedGroup = '';

    public $email;
    public $fname;
    public $mname;
    public $lname;
    public $isEmailVerified;

    public $uaPermission = false;
    public $chPermission = false;
    public $paPermission = false;
    public $mePermission = false;

    public $userRules = [
        'email' => 'required|email',
        'fname' => 'required|max:30',
        'mname' => 'nullable|string|max:30',
        'lname' => 'required|max:30',
    ];

    public $studentRules = [
        'selectedSchool' => 'required',
        'selectedSpecialization' => 'required',
        'selectedGroup' => 'required',
    ];

    public $userRuleAttributes = [
        'email' => 'email',
        'fname' => 'first Name',
        'mname' => 'middle Name',
        'lname' => 'last Name',
    ];

    public $studentRuleAttributes = [
        'selectedSchool' => 'School',
        'selectedSpecialization' => 'Specialization',
        'selectedGroup' => 'Group',
    ];

    public function mount() {
        $this->fname = $this->user->first_name;
        $this->mname = $this->user->middle_name;
        $this->lname = $this->user->last_name;
        $this->email = $this->user->email;
        ($this->user->email_verified === 'verified') ? $this->isEmailVerified = true : $this->isEmailVerified = false;

        // if user is a student, show student fields
        if ($this->user->hasRole('student')) {
            $this->showStudentFields = true;

            $this->schools = School::active()->get();
            $this->selectedSpecialization = $this->user->userSpecialization->specialization_id;
            $this->selectedSchool = $this->user->userSpecialization->specialization->school_id;
            $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();
            $this->selectedGroup = $this->user->userSpecialization->group_id;
            $this->groups = Group::select('id', 'name')->where('specialization_id', $this->selectedSpecialization)->get();

            // Check permissions of student
            if ($this->user->hasPermissionTo('access user accounts')) {
                 $this->uaPermission = true;
            }
            if ($this->user->hasPermissionTo('access project assessment')) {
                $this->paPermission = true;
            }
            if ($this->user->hasPermissionTo('access committee heads')) {
                $this->chPermission = true;
            }
            if ($this->user->hasPermissionTo('access manage events')) {
                $this->mePermission = true;
            }
        }
    }

    // Update values of specializations and groups based on the school
    public function updatedSelectedSchool() {
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();

        $this->reset('selectedSpecialization', 'selectedGroup', 'groups');
    }

    public function updatedSelectedSpecialization() {
        $this->groups = Group::select('id', 'name')->where('specialization_id', $this->selectedSpecialization)->get();

        $this->reset('selectedGroup');
    }


    public function updateUser() {
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

        // Check if the email is changed
        if ($this->user->email !== $this->email) {
            $this->validate([
                'email' => 'unique:users,email'
            ]);
        }

        // Update user info
        $this->user->first_name = Str::title($this->fname);
        $this->user->middle_name = Str::title($this->mname);
        $this->user->last_name = Str::title($this->lname);
        $this->user->email = $this->email;

        // If email is not yet verified and email is not registered by the user
        if ($this->user->email_verified !== 'verified' && $this->isEmailVerified && DB::table('register_users')->where('email', $this->user->email)->exists()) {
            DB::table('register_users')->where('email', $this->user->email)->delete();
        }

        $this->user->email_verified = $this->isEmailVerified;
        $this->user->save();

        // Check if user is student
        if ($this->showStudentFields) {
            // Update student specialization and group
            $this->user->userSpecialization()->update([
                'specialization_id' => $this->selectedSpecialization,
                'group_id' => $this->selectedGroup
            ]);

            // Update user which election to vote
            $electionId = Specialization::select('election_id')->where('id', $this->selectedSpecialization)->pluck('election_id')->first();
            $this->user->userElection()->update([
                'election_id' => $electionId,
            ]);

            // Assign permissions to student (if there's any)
            // User Accounts Permission
            if ($this->uaPermission) {
                $this->user->givePermissionTo('access user accounts');
            } else {
                $this->user->revokePermissionTo('access user accounts');
            }

            // Committee Heads Permission
            if ($this->chPermission) {
                $this->user->givePermissionTo('access committee heads');
            } else {
                $this->user->revokePermissionTo('access committee heads');
            }

            // Project Assessment Permission
            if ($this->paPermission) {
                $this->user->givePermissionTo('access project assessment');
            } else {
                $this->user->revokePermissionTo('access project assessment');
            }

            // Manage Events Permission
            if ($this->mePermission) {
                $this->user->givePermissionTo('access manage events');
            } else {
                $this->user->revokePermissionTo('access manage events');
            }
        }

        // Return success message
        session()->flash('status', 'green');
        session()->flash('message', 'User successfully updated');

        return redirect('users/' . $this->user->id);
    }

    public function render()
    {
        return view('livewire.users.view-user');
    }
}
