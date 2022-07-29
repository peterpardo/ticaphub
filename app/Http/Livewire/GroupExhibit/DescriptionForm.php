<?php

namespace App\Http\Livewire\GroupExhibit;

use App\Models\GroupExhibit;
use Livewire\Component;

class DescriptionForm extends Component
{
    public GroupExhibit $groupExhibit;
    public $showModal = false;
    public $title;
    public $description;

    protected $rules = [
        'title' => 'required|string|max:200',
        'description' => 'required|string',
    ];

    protected $listeners = ['showModal'];

    public function mount() {
        $this->title = $this->groupExhibit->title;
        $this->description = $this->groupExhibit->description;
    }

    public function showModal() {
        $this->showModal = true;
    }

    public function closeModal() {
        $this->showModal = false;
        $this->resetInputs();
    }

    public function resetInputs() {
        $this->title = $this->groupExhibit->title;
        $this->description = $this->groupExhibit->description;
    }

    public function updateDescription() {
        $this->validate();

        // If the word count of the description is greater than 200, return error
        if (str_word_count($this->description) > 200) {
            $this->addError('description', 'The description must have 200 word or less.');
            return;
        }

        // Update description
        $this->groupExhibit->title = $this->title;
        $this->groupExhibit->description = $this->description;
        $this->groupExhibit->save();

        session()->flash('status', 'green');
        session()->flash('message', 'Group Exhibit successfully updated');

        return redirect('/group-exhibit');
    }

    public function render()
    {
        return view('livewire.group-exhibit.description-form');
    }
}
