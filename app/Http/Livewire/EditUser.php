<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public User $user;
    public $selectedSpec;
    public $selectedSchool;
    public $selectedGroup;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $email;
    public $id_number;
    protected $rules = [
        'first_name' => 'required',
        'middle_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
    ];
    protected $messages = [
        'selectedSchool.required' => 'The School is required.',
        'selectedSpec.required' => 'The Specialization is required.',
    ];

    public function mount() {
        $this->first_name = $this->user->first_name;
        $this->middle_name = $this->user->middle_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        if($this->user->hasRole('student')) {
            $this->selectedSpec = $this->user->userSpecialization->specialization->id;
            $this->selectedSchool = $this->user->userSpecialization->school->id;
            $this->id_number = $this->user->userSpecialization->id_number;
            $this->selectedGroup = $this->user->userGroup->group->id;
        }
    }
    public function updateUser() {
        $this->validate();
        $user = User::find($this->user->id);
        if($user->email != $this->email) {
            if(User::where('email', $this->email)->exists()) {
                $this->addError('email', 'Email already exists');
                return back();
            }
        }
        $user->first_name = $this->first_name;
        $user->middle_name = $this->middle_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->save();
        if ($this->user->hasRole('student')) {
            $this->validate([
                'id_number' => 'required',
                'selectedSpec' => 'required',
                'selectedSchool' => 'required',
            ], [
                'selectedSchool.required' => 'The :attribute is required.',
                'selectedSpec.required' => 'The :attribute is required.',
            ], [
                'selectedSpec' => 'Specialization',       
                'selectedSchool' => 'School',       
            ]);
            $user->userSpecialization->school_id = $this->selectedSchool;
            $user->userSpecialization->specialization_id = $this->selectedSpec;
            $user->userSpecialization->id_number = $this->id_number;
            $user->userSpecialization->save();
            $user->userGroup->group_id = $this->selectedGroup;
            $user->userGroup->save();
        }
        $this->emit('userUpdated');
        return redirect()->route('users');
    }

    public function render()
    {   
        $schools = School::all();
        $specs = Specialization::all();
        $groups = Group::all();
        return view('livewire.edit-user', [
            'schools' => $schools,
            'specs' => $specs,
            'groups' => $groups,
        ]);
    }
    
}
