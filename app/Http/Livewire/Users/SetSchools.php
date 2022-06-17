<?php

namespace App\Http\Livewire\Users;

use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;
use Illuminate\Support\Str;

class SetSchools extends Component
{
    public $schools;
    public $specializations = [];
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

    public function mount() {
        $this->schools = School::all(['id', 'name']);
        $this->specializations = Specialization::with('school')->get();
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

            // Update specialization table
            $this->specializations = Specialization::with('school')->get();

            // Return success message
            session()->flash('status', 'green');
            session()->flash('message', 'Specialization successfully added');

            $this->reset(['name', 'selectedSchool']);
        }
    }

    public function render()
    {
        return view('livewire.users.set-schools');
    }
}
