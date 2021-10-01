<div>
    <h1 class="font-bold text-center text-3xl">Save Task</h1>
    <form wire:submit.prevent="saveTask">
            <div class="m-2">
                <label class="block font-semibold">Task Title</label>
                <input wire:model="title" type="text" class="rounded w-full">
                @error('title')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="m-2">
                <label class="block font-semibold">Task Description</label>
                <input wire:model="description" type="text" class="rounded w-full">
                @error('description')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="m-2">
                <label class="block font-semibold">Officers</label>
                <input wire:model="search" type="text" class="rounded w-full" placeholder="Search officers">
                <div class="absolute bg-white rounded z-40 max-h-40 overflow-auto">
                    @foreach ($officers as $officer)
                        <div>{{ $officer }}</div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-evenly my-5">
                <button wire:click.prevent="$emit('closeFormModal')" class="rounded shadow-lg px-4 py-2 hover:bg-gray-100">Cancel</button>
                <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Submit</button>
            </div>
        </div>
    </form>
</div>
