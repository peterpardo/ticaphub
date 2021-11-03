<div>
    <h1 class="font-bold text-xl my-3 text-center">{{ $event->name }}</h1>
    <a href="/events/{{ $event->id }}" class="bg-red-500 hover:bg-red-600 px-2 py-1 rounded text-white">Back</a>
    <form wire:submit.prevent='uploadProgramFlow'>
        <div class="w-1/2 shadow rounded px-2 py-4 mx-auto mb-3">
            <div class="text-center mb-3">
                <label class="font-semibold mb-2">Program flow</label>
                <input type="file" wire:model="programs"  class="block border rounded mx-auto" multiple/>
                @if(session('status'))
                <span class="inline-block text-{{ session('status') }}-500 rounded my-1 px-2 py-1">{{ session('message') }}</span>
                @endif
                @error('programs.*')
                <span class="inline-block text-red-500 rounded my-1 px-2 py-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 px-2 py-1 text-white rounded" >Submit</button>
            </div>
            <h1 class="font-semibold my-2">Program Preview</h1>
            @if($eventPrograms->count() != 0)
                @foreach($eventPrograms as $eventProgram)
                    @if($eventProgram->name == 'assets/program-flow-sample')
                        <img src="{{ asset(url($eventProgram->path))}}" class="w-full my-2">  
                    @else
                        <img src="{{ Storage::url($eventProgram->path)}}" class="w-full my-2">
                    @endif
                @endforeach
            @else
                <div class="block bg-gray-100 py-4 text-center rounded">No Program flows uploaded</div>
            @endif
        </div>
    </form>
</div>
