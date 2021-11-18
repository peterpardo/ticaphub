<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Kanban extends Component
{   
    public Event $event;
    public $title;
    public $listId;
    public $taskId;
    public $item;
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.kanban');
    }

    public function openModal($action, $id = null, $item = 'list') {
        if($action == 'add' || $action == 'update') {
            $this->emit('addOrUpdate', $action, $id);
            $this->dispatchBrowserEvent('openModal');
        } else {
            $this->item = $item;
            if($this->item == 'task') {
                $this->taskId = $id;
            } else {
                $this->listId = $id;
            }
            $this->dispatchBrowserEvent('openDeleteModal');
        }
    }

    public function closeDeleteModal() {
        $this->dispatchBrowserEvent('closeDeleteModal');
    }

    public function deleteItem() {
        if($this->item == 'list') {
            TaskList::find($this->listId)->delete();
            $this->emit('listDeleted');
        } else {
            Task::find($this->taskId)->delete();
            $this->emit('taskDeleted');
        }
        
        $this->emit('refreshParent');
    }
   
}
