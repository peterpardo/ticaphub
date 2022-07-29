<?php

namespace App\Http\Livewire\GroupExhibit;

use App\Models\GroupExhibit;
use Livewire\Component;

class LinksForm extends Component
{
    public GroupExhibit $groupExhibit;
    public $showModal = false;
    public $fb;
    public $yt;
    public $ig;
    public $tt;

    protected $rules = [
        'fb' => 'nullable|string|max:100',
        'yt' => 'nullable|string|max:100',
        'ig' => 'nullable|string|max:100',
        'tt' => 'nullable|string|max:100',
    ];

    protected $validationAttributes = [
        'fb' => 'Facebook',
        'yt' => 'Youtube',
        'ig' => 'Instagram',
        'tt' => 'Twitter',
    ];

    protected $listeners = ['showModal'];

    public function mount() {
        $this->setLinks();
    }

    public function showModal() {
        $this->showModal = true;
    }

    public function closeModal() {
        $this->showModal = false;
        $this->resetValidation();
        $this->setLinks();
    }

    public function setLinks() {
        $this->fb = $this->groupExhibit->facebook_link;
        $this->yt = $this->groupExhibit->youtube_link;
        $this->ig = $this->groupExhibit->instagram_link;
        $this->tt = $this->groupExhibit->twitter_link;
    }

    public function updateLinks() {
        $this->validate();

        // Update links
        $this->groupExhibit->facebook_link = $this->fb;
        $this->groupExhibit->youtube_link = $this->yt;
        $this->groupExhibit->instagram_link = $this->ig;
        $this->groupExhibit->twitter_link = $this->tt;
        $this->groupExhibit->save();

        session()->flash('status', 'green');
        session()->flash('message', 'Group Exhibit successfully updated');

        return redirect('/group-exhibit');
    }

    public function render()
    {
        return view('livewire.group-exhibit.links-form');
    }
}
