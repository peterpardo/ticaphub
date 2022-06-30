<?php

namespace App\Http\Livewire\Users;

use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class Groups extends Component
{
    use WithPagination;

    public $isActive = 'groups';

    protected $listeners = ['refreshParent'];

    public function refreshParent($action = null) {
        if ($action == 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'Group successfully added');
        } else if ($action == 'update') {
            session()->flash('status', 'green');
            session()->flash('message', 'Group successfully updated');
        }
    }

    public function render()
    {
        return view('livewire.users.groups', [
            'groups' => Group::select('id', 'name', 'specialization_id', 'adviser_id')->withCount('userSpecializations')->with(['adviser', 'specialization', 'specialization.school'])->paginate(5)
        ]);
    }
}
