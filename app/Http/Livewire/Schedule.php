<?php

namespace App\Http\Livewire;

use App\Models\Schedule as ModelsSchedule;
use Livewire\Component;

class Schedule extends Component
{   
    public $schedId;

    public function render()
    {
        $today = \Carbon\Carbon::now('Asia/Manila')->format('Y-m-j');
        $tomorrow = \Carbon\Carbon::tomorrow('Asia/Manila')->format('Y-m-j');

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
