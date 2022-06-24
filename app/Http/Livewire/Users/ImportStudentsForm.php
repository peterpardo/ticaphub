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

    protected $rules = [
        'selectedSchool' => 'required',
        'selectedSpecialization' => 'required',
        'file' => 'required|mimes:txt,csv'
    ];

    protected $messages = [
        'file.mimes' => 'The file type should be .csv'
    ];

    protected $validationAttributes = [
        'selectedSchool' => 'school',
        'selectedSpecialization' => 'specialization',
    ];

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
        $this->resetValidation();
        $this->reset('selectedSchool', 'selectedSpecialization', 'file');
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();
        $this->dispatchBrowserEvent('refreshFile');
    }

    public function downloadTemplate() {
        return response()->download(public_path('student-list-template.csv'));
    }

    public function uploadFile() {
        $validated = $this->validate();

        dd($this->file->originalName);

        $this->file->store('samples');

        dd('doone');
    }

    public function render()
    {
        return view('livewire.users.import-students-form');
    }
}
