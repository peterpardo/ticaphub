<?php

namespace App\Http\Livewire\Settings;

use App\Models\Specialization;
use Livewire\Component;

class SpecializationForm extends Component
{
    public $showForm = false;
    public $specializationId;
    public $name = '';
    public $school = '';

    protected $listeners = ['getSpecialization'];

    protected $rules = [
        'name' => 'required|min:5'
    ];

    public function getSpecialization($id) {
        $specialization = Specialization::find($id);
        $this->specializationId = $specialization->id;
        $this->name = $specialization->name;
        $this->school = $specialization->school->name;

        $this->showForm = true;
    }

    public function closeModal() {
        $this->resetValidation();
        $this->reset();
    }

    public function updateSpecialization() {
        $this->validate();

        // Update specialization name
        $specialization = Specialization::where('id', $this->specializationId)->update(['name' => $this->name]);

        if ($specialization) {
            // Refresh parent component and return success message
            $this->emit('refreshParent', 'success');
        }

        $this->resetValidation();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.settings.specialization-form');
    }
}
