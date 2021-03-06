<?php

namespace App\Http\Livewire\Users;

use App\Models\Adviser;
use App\Models\Group;
use App\Models\GroupExhibit;
use App\Models\School;
use App\Models\Specialization;
use Livewire\Component;
use Illuminate\Support\Str;

class GroupForm extends Component
{
    public $showForm = false;
    public $action = 'add';
    public $selectedGroup; // selected group to be updated

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
        'selectedAdviser' => 'required|numeric',
    ];

    protected $validationAttributes = [
        'selectedSchool' => 'school',
        'selectedSpecialization' => 'specialization',
        'selectedAdviser' => 'adviser'
    ];

    protected $listeners = ['showForm', 'getGroup'];

    public function mount() {
        $this->schools = School::select('id', 'name')->active()->get();
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();
        $this->advisers = Adviser::all(['id', 'name']);
    }

    public function getGroup($id) {
        $this->selectedGroup = Group::where('id', $id)->with(['specialization'])->first();
        $this->selectedId = $this->selectedGroup->id;

        $this->group = $this->selectedGroup->name;
        $this->selectedSchool = $this->selectedGroup->specialization->school_id;
        $this->selectedSpecialization = $this->selectedGroup->specialization_id;
        $this->selectedAdviser = $this->selectedGroup->adviser_id;

        $this->action = 'update';
        $this->showForm = true;
    }

    public function showForm() {
        $this->showForm = true;
        $this->emitUp('refreshParent');
    }

    public function closeModal() {
        $this->showForm = false;
        $this->reset('selectedSchool', 'selectedSpecialization', 'group', 'selectedAdviser', 'action', 'selectedGroup');
        $this->resetValidation();
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $this->selectedSchool)->get();
    }

    public function updatedSelectedSchool($value) {
        $this->specializations = Specialization::select('id', 'name')->where('school_id', $value)->get();
        $this->reset('selectedSpecialization');
    }

    public function addGroup() {
        $this->validate();

        // Lower case group name
        $formattedName = Str::lower($this->group);
        $runGroupNameValidation = true;

        // if action is update, check if validation for group name will be executed
        if ($this->action === 'update') {
            $oldGroupName = Str::lower($this->selectedGroup->name);

            // If old name is equal to new name, skip the validation
            if ($formattedName == $oldGroupName) {
                $runGroupNameValidation = false;
            }
        }

        // Check if group name is unique
        // Runs by default if action is equal to "add"
        if ($runGroupNameValidation) {
            $nameExists = Group::where('name', $formattedName)
            ->where('specialization_id', $this->selectedSpecialization)
            ->exists();
            if ($nameExists) {
                $this->addError('group', 'The group name must be unique.');
                return;
            };
        }

        // Check if adviser exists
        $adviser = Adviser::find($this->selectedAdviser);
        if (is_null($adviser)) {
            $this->addError('selectedAdviser', 'The adviser does not exist.');
            return;
        }

        // Check action if "add" or "update"
        if ($this->action === 'add') {
            // Create group
            $group = Group::create([
                'name' => $this->group,
                'specialization_id' => $this->selectedSpecialization,
                'ticap_id' => auth()->user()->ticap_id,
                'adviser_id' => $this->selectedAdviser,
            ]);

            // Create a exhibit for this group (to store all the files)
            GroupExhibit::create([
                'group_id' => $group->id,
                'ticap_id' => auth()->user()->ticap_id
            ]);
        } else {
            $group = Group::find($this->selectedGroup->id);

            // If group exists, update group details
            if ($group) {
                $group->name = $this->group;
                $group->specialization_id = $this->selectedSpecialization;
                $group->adviser_id = $this->selectedAdviser;
                $group->save();
            }
        }

        // Refresh parent component and return success message
        $this->emit('refreshParent', $this->action);

        // Hide modal
        $this->showForm = false;

        // Reset input fields
        $this->reset('selectedSchool', 'selectedSpecialization', 'group', 'selectedAdviser', 'action');
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.users.group-form');
    }
}
