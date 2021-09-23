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
    public $groups = null;

    public function render()
    {
        $specializations = Specialization::all();
        $schools = School::all();
        return view('livewire.add-student', [
            'schools' => $schools,
            'specializations' => $specializations,
        ]);
    }
    public function updatedSelectedSpec($specId){
        $this->groups = Group::where('specialization_id', $specId)
            ->where('school_id', $this->selectedSchool)
            ->get();
    }
}
