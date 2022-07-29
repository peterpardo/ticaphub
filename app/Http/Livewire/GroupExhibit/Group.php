<?php

namespace App\Http\Livewire\GroupExhibit;

use App\Models\GroupExhibit;
use Livewire\Component;

class Group extends Component
{
    public GroupExhibit $groupExhibit;

    public function render()
    {
        return view('livewire.group-exhibit.group');
    }
}
