<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\Specialization;
use Livewire\Component;

class AttendanceForm extends Component
{
    public $eventId;
    public $selectedSpec;
    public $fname;
    public $lname;
    public $mname;
    public $email;
    protected $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email|unique:attendance,email',
        'selectedSpec' => 'required',
    ];
    protected $messages = [
        'fname.required' => 'First name is required',
        'lname.required' => 'Last name is required',
        'email.required' => 'Email is required',
        'email.email' => 'Email must be valid',
        'selectedSpec.required' => 'Specialization is required',
    ];

    public function confirmAttendance() {
        $this->validate();
        Attendance::create([
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'email' => $this->email,
            'specialization_id' => $this->selectedSpec,
            'event_id' => $this->eventId,
        ]);
        $this->emit('confirmAttendance');
        $this->resetValidation();
        return redirect('/');
    }
    public function render()
    {   
        return view('livewire.attendance-form', [
            'specs' => Specialization::all(),
            'event' => Event::find($this->eventId)
        ]);
    }
}
