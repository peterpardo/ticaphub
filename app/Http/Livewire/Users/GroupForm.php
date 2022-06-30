<?php

namespace App\Http\Livewire\Users;

use App\Models\Adviser;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;
use Illuminate\Support\Str;

class GroupForm extends Component
{
    public $showForm = false;

    public $schools = [];
    public $selectedSchool = 1;
    public $specializations = [];
    public $selectedSpecialization = '';
    public $group = '';
    public $advisers = [];
    public $selectedAdviser = '';

    protected $rules = [
        'selectedSchool' => 'required|numeric',
        'selectedSpecialization' => 'required|numeric',
        'group' => 'required|max:50',
        'adviser' => 'numeric',
    ];

    protected $validationAttributes = [
        'selectedSchool' => 'school',
        'selectedSpecialization' => 'specialization'
    ];

    protected $listeners = ['showForm'];

    public function mount() {
        $this->schools = School::select('id', 'name')->active()->get();
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();
        // $this->advisers = Adviser::
    }

    public function showForm() {
        $this->showForm = true;
    }

    public function closeModal() {
        $this->showForm = false;
        $this->reset('selectedSchool', 'selectedSpecialization', 'group', 'adviser');
        $this->resetValidation();
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();
    }

    public function updatedSelectedSchool($value) {
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $value)->get();
        $this->reset('selectedSpecialization');
    }

    public function addGroup() {
        $this->validate();

        // Check if group name is unique
        $formattedName = Str::lower($this->group);
        $nameExists = Group::where('name', $formattedName)
            ->where('specialization_id', $this->selectedSpecialization)
            ->exists();
        if ($nameExists) {
            $this->addError('group', 'The group name must be unique.');
            return;
        };

        // // Add group
        // Group::create([
        //     'name' => $this->newGroup,
        //     'specialization_id' => $this->selectedSpecialization,
        //     'ticap_id' => auth()->user()->ticap_id,
        // ]);


        // additional validations
        // group - unique for each specialization
        // adviser - id must exists in the adviser table
        // dd('add group');
    }

    public function render()
    {
        return view('livewire.users.group-form');
    }
}
