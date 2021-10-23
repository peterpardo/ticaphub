<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Livewire\Component;

class AttendanceTable extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.attendance-table', [
            'attendees' => Attendance::when($this->search, function($q) {
                $q->where('fname', 'like', '%'.trim($this->search).'%')
                    ->orWhere('mname', 'like', '%'.trim($this->search).'%')
                    ->orWhere('lname', 'like', '%'.trim($this->search).'%')
                    ->orWhere('email', 'like', '%'.trim($this->search).'%');
            })
            ->with(['event'])
            ->paginate(4)
        ]);
    }
}
