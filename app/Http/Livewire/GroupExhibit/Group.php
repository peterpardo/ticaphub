<?php

namespace App\Http\Livewire\GroupExhibit;

use App\Models\Group as ModelsGroup;
use Livewire\Component;

class Group extends Component
{
    public ModelsGroup $group;

    public function render()
    {
        return view('livewire.group-exhibit.group');
    }
}
