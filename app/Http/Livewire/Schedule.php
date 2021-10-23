<?php

namespace App\Http\Livewire;

use App\Models\Schedule as ModelsSchedule;
use Livewire\Component;

class Schedule extends Component
{   
    public $schedId;

    public function render()
    {
        $today = \Carbon\Carbon::today()->format('Y-m-j');
        $tomorrow = \Carbon\Carbon::tomorrow()->format('Y-m-j');

        return view('livewire.schedule' ,[
            'today' => $today,
            'tomorrow' => $tomorrow,
        ]);
    }

    public function deleteSched($schedId) {
        $this->schedId = $schedId;
        $this->dispatchBrowserEvent('openDeleteModal');
    }

    public function delete() {
        ModelsSchedule::find($this->schedId)->delete();
        $this->emit('schedDeleted');
    }

    public function closeDeleteModal() {
        $this->dispatchBrowserEvent('closeDeleteModal');
    }
}
