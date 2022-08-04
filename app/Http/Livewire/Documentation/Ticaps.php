<?php

namespace App\Http\Livewire\Documentation;

use App\Models\Ticap;
use Livewire\Component;
use Livewire\WithPagination;

class Ticaps extends Component
{
    use WithPagination;

    public $selectedTicap;
    public $showDeleteModal = false;

    public function selectItem($id) {
        $this->selectedTicap = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal() {
        $this->selectedTicap = null;
        $this->showDeleteModal = false;
    }

    public function deleteTicap() {
        dd($this->selectedTicap);
    }

    public function render()
    {
        return view('livewire.documentation.ticaps', [
            'ticaps' => Ticap::orderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}
