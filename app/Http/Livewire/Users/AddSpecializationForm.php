<?php

namespace App\Http\Livewire\Users;

use App\Models\Election;
use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;
use Illuminate\Support\Str;

class AddSpecializationForm extends Component
{
    public $name = "";
    public $selectedSchool = 1;     // id of FEU TECH
    public $schools;

    protected $listeners = ['refreshForm' => '$refresh'];

    protected $rules = [
        'name' => 'required|min:5',
        'selectedSchool' => 'required',
    ];

    protected $validationAttributes = [
        'name' => 'Specialization Name',
        'selectedSchool' => 'School'
    ];

    public function closeModal() {
        // Reset fiels and remove validations if there's any
        $this->reset('name', 'selectedSchool');
        $this->resetValidation();

        $this->emit('refreshParent');
    }

    public function addSpecialization() {
        $this->validate();

        // Check if specialization already exists in the school
        $formattedName = Str::title($this->name);
        $nameExists = Specialization::where([
            ['school_id', '=', $this->selectedSchool],
            ['name', '=', $formattedName],
        ])->exists();

        if ($nameExists) {
           // Return error message
           $this->addError('name', 'The Specialization Name must be unique.');
        } else {
            // Create specialization
            $specialization = Specialization::create([
                'name' => $formattedName,
                'school_id' => $this->selectedSchool,
            ]);

            // Check school (for creation of election)
            if ($this->selectedSchool == 1) {
                $school = School::where('id', $this->selectedSchool)->pluck('name')->first();
                // Create election for each specialization in FEU TECH
                $election = Election::create([
                    'name' => $school . ' | ' . $formattedName,
                    'ticap_id' => auth()->user()->ticap_id,
                ]);

                // Add Election id to FEU TECH specializations
                Specialization::where('id', $specialization->id)->update(['election_id' => $election->id]);
            }

            // Refresh parent component and return success message
            $this->emit('refreshParent', 'success');

            $this->reset('name', 'selectedSchool');
        }
    }

    public function render()
    {
        return view('livewire.users.add-specialization-form');
    }
}
