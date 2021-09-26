<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddStudent extends Component
{
    public $selectedSpec = null;
    public $selectedSchool = null;
    public $specializations = null;
    public $groups = null;
    public $selectedGroup;

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
    public function render()
    {
        $schools = School::where('is_involved', 1)->get();
        return view('livewire.add-student', [
            'schools' => $schools,
        ]);
    }
}
