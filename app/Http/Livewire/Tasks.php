<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\TaskList;
use Livewire\Component;

class Tasks extends Component
{
    public TaskList $list;
    public Event $event;

    public function addTask() {
        $this->dispatchBrowserEvent('openFormModal');
    }
    public function render()
    {
        return view('livewire.tasks');
    }
}
