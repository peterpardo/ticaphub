<?php

namespace App\Http\Livewire\GroupExhibit;

use App\Models\GroupExhibit;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageForm extends Component
{
    use WithFileUploads;

    public GroupExhibit $groupExhibit;
    public $action = 'hero';
    public $showModal = false;
    public $file;

    protected $rules = [
        'file' => 'required|image|max:15000'
    ];

    protected $listeners = ['showModal'];

    public function showModal($action) {
        if ($action == 'poster') {
            $this->action = 'poster';
        }
        $this->showModal = true;
    }

    public function closeModal() {
        $this->reset('action', 'showModal', 'file');
        $this->resetValidation();
    }

    public function updateImage() {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.group-exhibit.image-form');
    }
}
