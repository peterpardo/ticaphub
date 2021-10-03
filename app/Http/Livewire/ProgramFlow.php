<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\ProgramFlow as ModelsProgramFlow;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProgramFlow extends Component
{
    use WithFileUploads;

    public Event $event;
    public $programs = [];
    public $sample;
    protected $rules = [
        'programs.*' => 'image',
    ];
    protected $messages = [
        'programs.*.image' => 'File/s should be an image',
    ];

    public function render()
    {
        $eventPrograms = ModelsProgramFlow::where('event_id', $this->event->id)->get();
        return view('livewire.program-flow', [
            'eventPrograms' => $eventPrograms
        ]);
    }
    public function uploadProgramFlow() {
        $this->validate();
        if(count($this->programs) == 0) {
            session()->flash('status', 'red');
            session()->flash('message', 'Program flow required');
        } else {
            // DELETE PROGRAM FLOWS IF EXISTS
            if($this->event->programFlows()->exists()) {
                foreach($this->event->programFlows as $programFlow) {
                    unlink(storage_path('app/public/' . $programFlow->path));
                    $programFlow->delete();
                }
            }
            foreach($this->programs as $program) {
                $path = 'event-programs/';
                $extension = $program->extension();
                $fileName = Str::uuid() . '.' . $extension;
                $originalName = $program->getClientOriginalName();
                $program->storeAs($path, $fileName, 'public');
                $this->event->programFlows()->create([
                    'name' => $originalName,
                    'path' => $path . $fileName,
                ]);
            }
            session()->flash('status', 'green');
            session()->flash('message', 'Program successfully saved');
            return redirect('events/'.$this->event->id.'/program-flow');
        }
    }
}
