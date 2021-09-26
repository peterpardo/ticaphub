<?php

namespace App\Http\Livewire;

use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;

class ImportStudent extends Component
{
    public $selectedSchool;
    public $selectedSpec;
    public $specializations;

    public function updatedSelectedSchool($schoolId) {
        $this->specializations = Specialization::where('school_id', $schoolId)->get();
    }
    public function render()
    {
        $schools = School::where('is_involved', 1)->get();
        return view('livewire.import-student', [
            'schools' => $schools
        ]);
    }
}
