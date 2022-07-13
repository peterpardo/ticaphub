<?php

namespace App\Http\Livewire\Officers;

use App\Models\Election;
use App\Models\Position;
use Livewire\Component;
use Livewire\WithPagination;

class SetPositions extends Component
{
    use WithPagination;

    public Election $election;
    public $showDeleteModal = false;
    public $selectedPositionId;

    protected $listeners = ['refreshParent'];

    public function refreshParent($message = null) {
        if ($message === 'add') {
            session()->flash('status', 'green');
            session()->flash('message', 'Position successfully added');
        } else if ($message === 'edit') {
            session()->flash('status', 'green');
            session()->flash('message', 'Position successfully updated');
        } else if ($message === 'error') {
            session()->flash('status', 'red');
            session()->flash('message', 'Something went wrong. Try again later.');
        }
    }

    public function selectItem($id) {
        $this->selectedPositionId = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal() {
        $this->showDeleteModal = false;
    }

    public function deleteItem() {
        $isPositionDeleted = Position::destroy($this->selectedPositionId);

        if ($isPositionDeleted) {
            session()->flash('status', 'green');
            session()->flash('message', 'Position successfully deleted');
        } else {
            session()->flash('status', 'red');
            session()->flash('message', 'Something went wrong. Try again later');
        }

        // Reset selected position
        $this->reset('selectedPositionId');

        // Close modal
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.officers.set-positions', [
            'positions' => Position::where('election_id', $this->election->id)->paginate(5)
        ]);
    }
}
