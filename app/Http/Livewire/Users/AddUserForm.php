<?php

namespace App\Http\Livewire\Users;

use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;

class AddUserForm extends Component
{
    // User info
    public $fname;
    public $lname;
    public $email;
    public $isStudent = true;
    public $role = 'student';

    // Students info only
    public $idNumber;
    public $selectedSchool = 1;
    public $specializations = [];
    public $selectedSpecialization = "";
    public $groups = [];
    public $selectedGroup = "";
    public $advisers = [];
    public $selectedAdviser;

    public function mount() {
        $this->specializations = Specialization::where('school_id', $this->selectedSchool)->get();
    }

    public function addUser() {
        dd('add user');
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

    public function render()
    {
        return view('livewire.users.add-user-form', [
            'schools' => School::where('is_involved', 1)->get(),
        ]);
    }
}
