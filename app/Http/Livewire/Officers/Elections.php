<?php

namespace App\Http\Livewire\Officers;

use App\Models\Election;
use Livewire\Component;
use Livewire\WithPagination;

class Elections extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.officers.elections', [
            'elections' => Election::withCount('userElections')->paginate(5)
        ]);
    }
}
