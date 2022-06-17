<?php

namespace App\Http\Livewire\Users;

use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class SetSchools extends Component
{
    use WithPagination;

    public $name = "";
    public $selectedSchool = 1; // id of FEU TECH

    protected $rules = [
        'name' => 'required|min:5',
        'selectedSchool' => 'required',
    ];

    protected $validationAttributes = [
        'name' => 'Specialization Name',
        'selectedSchool' => 'School'
    ];

    // Change status of school
    public function changeSchoolStatus($status, $id) {
        School::where('id', $id)->update(['is_involved' => !$status]);
        $this->reset();
    }

    public function updatedName() {
        $this->resetValidation();
    }

    public function addSpecialization() {
        $this->validate();

        // Check if specialization already exists in the school
        $school = School::with('specializations')->find($this->selectedSchool);
        $formattedName = Str::title($this->name);
        if ($school->specializations()->where('name', $formattedName)->exists()) {
            // Return error message
            session()->flash('status', 'red');
            session()->flash('message', $formattedName . ' already exists in ' . $school->name);
        } else {
            // Create specialization
            $school->specializations()->create([
                'name' => $formattedName
            ]);

            // Return success message
            session()->flash('status', 'green');
            session()->flash('message', 'Specialization successfully added');

            // Reset input fields
            $this->reset(['name', 'selectedSchool']);
        }
    }

    public function render()
    {
        return view('livewire.users.set-schools', [
            'schools' => School::all(['id', 'name', 'is_involved']),
            'specializations' => Specialization::with('school')->paginate(5)
        ]);
    }
}
