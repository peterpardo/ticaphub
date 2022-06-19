<?php

namespace App\Http\Livewire\Users;

use App\Models\School;
use Livewire\Component;
use Illuminate\Support\Str;

class AddSpecializationForm extends Component
{
    public $schools;
    public $name = "";
    public $selectedSchool = 1;     // id of FEU TECH

    protected $rules = [
        'name' => 'required|min:5',
        'selectedSchool' => 'required',
    ];

    protected $validationAttributes = [
        'name' => 'Specialization Name',
        'selectedSchool' => 'School'
    ];

    public function addSpecialization() {
        $this->validate();

        // Check if specialization already exists in the school
        $school = School::with('specializations:id,name')->find($this->selectedSchool);
        $formattedName = Str::title($this->name);
        if ($school->specializations()->where('name', $formattedName)->exists()) {
            // Return error message
            $this->addError('name', 'The Specialization Name must be unique.');
        } else {
            // Create specialization
            $school->specializations()->create([
                'name' => $formattedName
            ]);

            // Refresh parent component and return success message
            $this->emit('refreshParent', 'success');
        }
    }

    public function render()
    {
        return view('livewire.users.add-specialization-form');
    }
}
