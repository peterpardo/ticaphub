<?php

namespace App\Http\Livewire\Users;

use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class Groups extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.users.groups', [
            'groups' => Group::withCount('userSpecializations')->with(['adviser', 'specialization', 'specialization.school'])->paginate(5)
        ]);
    }
}
