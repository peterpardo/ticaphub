<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class ListForm extends Component
{
    public $title;
    public $eventId;
    public $listId;
    public $action;
    protected $listeners = [
        'addOrUpdate',
        'closeModal'
    ];

    public function render()
    {
        return view('livewire.list-form');
    }

    public function closeModal() {
        $this->resetValidation();
        $this->dispatchBrowserEvent('closeModal');
    }

    public function addList() {
        $this->validate([
            'title' => 'required|string|max:20',
        ]);

        if($this->action == 'add') {
            $event = Event::find($this->eventId);
            $event->lists()->create([
                'title' => Str::title($this->title),
                'user_id' => Auth::user()->id,
            ]);
            $this->emit('listAdded');
        } else {
            TaskList::where('id', $this->listId)->update(['title' => $this->title]);
            $this->emit('listUpdated');
        }
       

        $this->reset();
        $this->resetValidation();
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function addOrUpdate($action, $id) {
        $this->action = $action;
        if($action == 'add') {
            $this->eventId = $id;
        } else {
            $this->listId = $id;
            $list = TaskList::find($this->listId);
            $this->title = $list->title;
        }
    }
}
