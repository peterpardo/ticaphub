<?php

namespace App\Http\Livewire\Users;

use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportStudentsForm extends Component
{
    use WithFileUploads;

    public $selectedSpecialization = "";
    public $selectedSchool = 1; // FEU TECH
    public $file;
    public $schools;
    public $specializations;

    public function mount() {
        $this->schools = School::select('id', 'name')->active()->get();
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();
    }

    public function updatedSelectedSchool() {
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();
        $this->reset('selectedSpecialization');
    }

    public function closeModal() {
        // Reset to default values
        $this->reset('selectedSchool', 'selectedSpecialization', 'file');
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();
        $this->dispatchBrowserEvent('refreshFile');
    }

    public function uploadFile() {
        dd('upload');
    }

    public function render()
    {
        return view('livewire.users.import-students-form');
    }
}
