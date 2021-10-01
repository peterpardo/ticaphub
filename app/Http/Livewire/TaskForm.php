<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class TaskForm extends Component
{
    public $title;
    public $description;
    public $search;

    protected $listeners = [
        'closeFormModal'
    ];

    public function saveTask() {
        dd('save');
    }
    public function closeFormModal() {
        $this->dispatchBrowserEvent('closeFormModal');
    }
    public function render()
    {
        return view('livewire.task-form', [
            'officers' => User::role(['officer', 'chairman'])->
            when($this->search, function($q){
                $q->search(trim($this->search));
            })->get(),
        ]);
    }
}
