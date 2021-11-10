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
    
    public $title;
    public $description;
    public $programs = [];
    public $sample;
    protected $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
        'programs.*' => 'required|image',
    ];
    protected $messages = [
        'programs.*.image' => 'File/s should be an image',
    ];

    public function mount() {
        if($this->event->programFlow) {
            $this->title = $this->event->programFlow->title;
            $this->description = $this->event->programFlow->description;
        }
    }
    public function render()
    {
        return view('livewire.program-flow');
    }
    
    public function createPost() {
        $this->validate();
        if(($this->event->programFlow && $this->title == $this->event->programFlow->title && $this->description == $this->event->programFlow->description) && count($this->programs) == 0) {
            session()->flash('status', 'red');
            session()->flash('message', 'Program flow required');
        } else {
            if(count($this->programs) == 0 && ($this->event->programFlow && ($this->title != $this->event->programFlow->title && $this->description == $this->event->programFlow->description) && ($this->title == $this->event->programFlow->title && $this->description != $this->event->programFlow->description))) {
                session()->flash('status', 'red');
                session()->flash('message', 'Program flow required');
            } else {
                // CREATE NEW POST IF NO POST EXSISTS
                $post = ModelsProgramFlow::updateOrCreate(
                    ['id' => $this->event->id],
                    ['title' => $this->title,'description' => $this->description, 'event_id' => $this->event->id]
                );
                // SAVE PROGRAM FLOW FILE/S
                if($this->programs) {
                     // DELETE PROGRAM FLOWS IF EXISTS
                    if($this->event->programs()->exists()) {
                        foreach($this->event->programs as $programFlow) {
                            if($programFlow->name != 'assets/program-flow-sample') {
                                unlink(storage_path('app/public/' . $programFlow->path));
                            }
                            $programFlow->delete();
                        }
                    }
                    foreach($this->programs as $program) {
                        $path = 'event-programs/';
                        $extension = $program->extension();
                        $fileName = Str::uuid() . '.' . $extension;
                        $originalName = $program->getClientOriginalName();
                        $program->storeAs($path, $fileName, 'public');
                        $this->event->programs()->create([
                            'name' => $originalName,
                            'path' => $path . $fileName,
                            'program_flow_id' => $post->id, 
                        ]);
                    }
                }
            
                session()->flash('success', 'Program successfully saved');
                return redirect('events/'.$this->event->id.'/program-flow');
            }
        }
    }
}
