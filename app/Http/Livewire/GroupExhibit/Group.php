<?php

namespace App\Http\Livewire\GroupExhibit;

use App\Models\GroupExhibit;
use Livewire\Component;

class Group extends Component
{
    public GroupExhibit $groupExhibit;

    protected $listeners = ['refreshParent'];

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
