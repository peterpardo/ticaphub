<?php

namespace App\Http\Livewire\GroupExhibit;

use App\Models\Adviser;
use App\Models\Group as ModelsGroup;
use App\Models\GroupExhibit;
use Livewire\Component;

class Group extends Component
{
    public GroupExhibit $groupExhibit;
    public $adviser = null;
    public $members;

    protected $listeners = ['refreshParent'];

    public function mount() {
        $group = ModelsGroup::where('id', $this->groupExhibit->group_id)->first();

        // Check if group has adviser
        if (!is_null($group->adviser_id)) {
            $this->adviser = Adviser::find($group->adviser_id);
        }
    }

    public function refreshParent($status) {
        if ($status == 'success') {
            session()->flash('status', 'green');
            session()->flash('message', 'Group Exhibit successfully updated');
        } else {
            session()->flash('status', 'red');
            session()->flash('message', 'Something went wrong. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.group-exhibit.group');
    }
}
