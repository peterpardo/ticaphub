<?php

namespace App\Http\Livewire\Users;

use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use App\Models\UserSpecialization;
use Livewire\Component;

class ViewUser extends Component
{
    public User $user;
    public $showStudentFields = false;
    public $schools;
    public $specializations;
    public $groups;
    public $selectedSchool;
    public $selectedSpecialization;
    public $selectedGroup;

    public $userRules = [
        'email' => 'required|email',
        'fname' => 'required|max:30',
        'mname' => 'string|max:30',
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
        'mname' => 'Middle Name',
        'lname' => 'Last Name',
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

        // if user is a student, show student fields
        if ($this->user->hasRole('student')) {
            $this->showStudentFields = true;

            $this->schools = School::active()->get();
            $this->selectedSpecialization = $this->user->userSpecialization->specialization_id;
            $this->selectedSchool = $this->user->userSpecialization->specialization->school_id;
            $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();
            $this->selectedGroup = $this->user->userSpecialization->group_id;
            $this->groups = Group::select('id', 'name')->where('specialization_id', $this->selectedSpecialization)->get();
        }
    }

    public function render()
    {
        return view('livewire.users.view-user');
    }
}
