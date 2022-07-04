<?php

namespace App\Http\Livewire\Settings;

use App\Models\Specialization;
use Livewire\Component;
use Livewire\WithPagination;

class Specializations extends Component
{
    use WithPagination;

    public $isActive = 'specializations';

    protected $listeners = ['refreshParent'];

    public function refreshParent($message = null) {
        if ($message === 'success') {
            session()->flash('status', 'green');
            session()->flash('message', 'Specialization successfully updated');
        }
    }

    public function render()
    {
        return view('livewire.settings.specializations', [
            'specializations' => Specialization::with('school')->paginate(5),
        ]);
    }
}
