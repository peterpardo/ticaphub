<div>
    <h1 class="font-bold text-3xl my-3 text-center">{{ $event->name }}</h1>
    <form wire:submit.prevent='createPost'>
        <div class="w-1/2 shadow rounded px-4 py-4 mx-auto mb-3">
            <a href="/events/{{ $event->id }}" class="inline-block bg-red-500 hover:bg-red-600 px-2 py-1 rounded text-white">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                    <span class="inline-block ml-2">Back</span>
                </div>
            </a>
            <div class="mb-3 w-3/4 mx-auto">
                <h1 class="font-bold text-xl mb-3 text-center">Create Post</h1>
                @if(session('success'))
                    <div class="bg-green-500 rounded text-center text-white my-1 px-2 py-3">{{ session('success') }}</div>
                @endif
                <div class="mb-2">
                    <label class="font-semibold mb-2">Title</label>
                    <input type="text" wire:model="title" class="w-full rounded" placeholder="Enter Title">
                    @error('title')
                        <div class="bg-red-500 rounded text-white my-1 px-2 py-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="font-semibold mb-2">Desription</label>
                    <textarea wire:model="description" class="w-full rounded resize-none" placeholder="Enter Description"></textarea>
                    @error('description')
                        <div class="bg-red-500 rounded text-white my-1 px-2 py-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="font-semibold mb-2">Program flow</label>
                    <input type="file" wire:model="programs" class="block border rounded w-full" multiple/>
                    @if(session('status'))
                        <div class="bg-{{ session('status') }}-500 rounded text-white my-1 px-2 py-1">{{ session('message') }}</div>
                    @endif
                    @error('programs.*')
                        <div class="bg-red-500 rounded text-white my-1 px-2 py-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 px-2 py-1 text-white rounded" >Submit</button>
                </div>
            </div>
            <h1 class="font-semibold my-2">Program Preview</h1>
            @if($event->programs->count() != 0)
                @foreach($event->programs as $program)
                    @if($program->name == 'assets/program-flow-sample')
                        <img src="{{ asset(url($program->path))}}" class="w-full my-2">  
                    @else
                        <img src="{{ Storage::url($program->path)}}" class="w-full my-2">
                    @endif
                @endforeach
            @else
                <div class="block bg-gray-100 py-4 text-center rounded">No Program flows uploaded</div>
            @endif
        </div>
    </form>
</div>
