<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $userId;
    public $school;
    public $specialization;
    public $group;

    public function render()
    {   
        $specializations = Specialization::all();
        $groups = Group::all();
        $user = User::find($this->userId);
        return view('livewire.edit-user', [
            'user' => $user,
            'specializations' => $specializations,
            'groups' => $groups,
        ]);
    }
    
}
