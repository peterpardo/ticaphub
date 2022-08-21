<?php

namespace App\Http\Livewire\Users;

use App\Models\Award;
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

    public $dilimanCheckbox;
    public $alabangCheckbox;
    public $selectedSpecialization;
    public $showDeleteModal = false;
    public $showConfirmModal = false;

    protected $listeners = ['refreshParent'];

    public function mount() {
        // Get diliman and alabang status (is_involved column)
        $schoolStatus = School::where('id', '!=', 1)->pluck('is_involved');
        $this->dilimanCheckbox = $schoolStatus[0];
        $this->alabangCheckbox = $schoolStatus[1];
    }

    public function refreshParent($message = null) {
        if ($message === 'success') {
            session()->flash('status', 'green');
            session()->flash('message', 'Specialization successfully added');
        }
    }

    // Change status of school
    public function changeSchoolStatus($id) {
        if ($id === 2) {
            School::where('id', $id)->update(['is_involved' => $this->dilimanCheckbox]);
        } else {
            School::where('id', $id)->update(['is_involved' => $this->alabangCheckbox]);
        }

        // // Delete All specializations of removed school
        Specialization::where('school_id', $id)->delete();

        // Refresh add specialization form
        $this->emit('refreshForm');
    }

    public function selectItem($id) {
        $this->selectedSpecialization = $id;

        $this->showDeleteModal = true;
    }

    public function closeModal($modal) {
        if ($modal === 'delete') {
            $this->showDeleteModal = false;
        }
    }

    public function deleteItem() {
        $specialization = Specialization::where('id', $this->selectedSpecialization)->with('election:id')->get()->first();

        // Check school of specialization
        if ($specialization->school_id === 1) {
            // Delete election and specialization
            Election::destroy($specialization->election->id);
        } else {
            // Delete only specialization
            Specialization::destroy($this->selectedSpecialization);
        }

        // // Reset properties to default value
        $this->reset(['selectedSpecialization']);

        // // Return success message
        session()->flash('status', 'green');
        session()->flash('message', 'Specialization successfully deleted');

        // Close modal
        $this->showDeleteModal = false;
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
            // Check if diliman and alabang are involved in the ticap
            $schools = School::where([
                ['id', '!=',  1],
                ['is_involved', '=', 1]
            ])->get();

            // Create an election for each school if involved and assign each specialization to their respective election
            foreach ($schools as $school) {
                // e.g. Election name: FEU DILIMAN
                $election = Election::create([
                    'name' => $school->name,
                    'ticap_id' => auth()->user()->ticap_id
                ]);

                Specialization::where('school_id', $school->id)->update(['election_id' => $election->id]);
            }

            // Create award for each specialization (BEST CAPSTONE PROJECT)
            $specializations = Specialization::all(['id']);

            foreach ($specializations as $specialization) {
                Award::create([
                    'name' => 'BEST CAPSTONE PROJECT',
                    'specialization_id' => $specialization->id,
                ]);
            }

            // Change TICAP status column(invitation_is_set)
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
