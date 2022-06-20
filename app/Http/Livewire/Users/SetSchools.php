<?php

namespace App\Http\Livewire\Users;

use App\Models\Election;
use App\Models\School;
use App\Models\Specialization;
use App\Models\Ticap;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class SetSchools extends Component
{
    use WithPagination;

    public $selectedSpecialization;
    public $showConfirmModal = false;
    public $showAddModal = false;

    protected $listeners = ['refreshParent'];

    public function refreshParent($message = null) {
        if ($message === 'success') {
            session()->flash('status', 'green');
            session()->flash('message', 'Specialization successfully added');
        }

        $this->showAddModal = false;
    }

    // Change status of school
    public function changeSchoolStatus($status, $id) {
        School::where('id', $id)->update(['is_involved' => !$status]);

        // Delete All specializations of removed school
        Specialization::where('school_id', $id)->delete();

        // Refresh add specialization form
        $this->emit('refreshForm');
    }


    // // Open modal
    // public function openModal($action, $id = null) {
    //     if ($action === 'delete') {
    //         $this->selectedSpecialization = $id;
    //         $this->showDeleteModal = true;
    //     } else if ($action === 'add') {
    //         $this->showAddModal = true;
    //     } else {
    //         $this->showConfirmModal = true;
    //     }
    // }

    // // Close modal
    // public function closeModal($action) {
    //     if ($action === 'delete') {
    //         $this->selectedSpecialization = null;
    //         $this->showDeleteModal = false;
    //     }  else if ($action === 'add') {
    //         $this->showAddModal = false;
    //     } else {
    //         $this->showConfirmModal = false;
    //     }
    // }

    public function selectItem($id) {
        $this->selectedSpecialization = $id;
    }

    public function deleteItem() {
        // Delete selected specialization
        Specialization::destroy($this->selectedSpecialization);

        // Reset properties to default value
        $this->reset(['showDeleteModal', 'selectedSpecialization']);

        // Return success message
        session()->flash('status', 'green');
        session()->flash('message', 'Specialization successfully deleted');
    }

    // Finalize Settings
    public function confirmSettings() {
        // Check if involved schools has atleast 1 specialization
        $schools = School::where('is_involved', 1)->doesntHave('specializations')->get('name');
        if ($schools->isNotEmpty()) {
            $this->showConfirmModal = false;

            // Return error message
            session()->flash('status', 'red');
            session()->flash('message', $schools[0]->name . ' has no specializations.');
        } else {
            $specializations = Specialization::select('id', 'name', 'school_id')->with('school:id,name')->get();

            // Insert elections (Ex: FEU TECH | Web And Mobile Application)
            foreach ($specializations as $specialization) {
                Election::insert([
                    'name' => $specialization->school->name . ' | ' . $specialization->name,
                    'specialization_id' => $specialization->id,
                    'ticap_id' => auth()->user()->ticap_id,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ]);
            }

            // Change TICAP status - invitation_is_set
            Ticap::where('id', auth()->user()->ticap_id)->update(['invitation_is_set' => 1]);

            // Return success message
            session()->flash('status', 'green');
            session()->flash('message', 'Awesome! The TICAP settings has been set.');

            return redirect('users');
        }
    }

    public function render()
    {
        return view('livewire.users.set-schools', [
            'schools' => School::select('id', 'name', 'is_involved')->withCount('specializations')->get(),
            'specializations' => Specialization::orderBy('school_id')->with('school')->paginate(5)
        ]);
    }
}
