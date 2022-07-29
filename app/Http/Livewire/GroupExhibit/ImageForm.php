<?php

namespace App\Http\Livewire\GroupExhibit;

use App\Models\GroupExhibit;
use Livewire\Component;

class ImageForm extends Component
{
    public GroupExhibit $groupExhibit;
    public $action = 'hero';
    public $showModal = false;
    public $image;

    protected $rules = [
        'image' => 'required|image|max:10000'
    ];

    protected $listeners = ['showModal'];

    public function showModal($action) {
        if ($action == 'poster') {
            $this->action = 'poster';
        }
        $this->showModal = true;
    }

    public function closeModal() {
        $this->reset('action', 'showModal', 'image');
        $this->resetValidation();
    }

    public function updateImage() {
        dd('updating image');
    }

    public function render()
    {
        return view('livewire.group-exhibit.image-form');
    }
}
