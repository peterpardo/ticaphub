<div>
    <h1 class="font-bold text-center text-3xl">Update Group Exhibit</h1>
    <form wire:submit.prevent="updateExhibit">
            <div class="m-2">
                <label class="block font-semibold">Project Title</label>
                <input wire:model="title" type="text" class="rounded w-full">
                @error('title')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="m-2">
                <label class="block font-semibold">Project Description</label>
                <textarea wire:model="description" class="w-full resize-none rounded"></textarea>
                @error('description')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="m-2">
                <label class="block font-semibold">Hero Image</label>
                <input wire:model="heroFile" type="file" class="rounded w-full mb-2">
                <span wire:loading wire:target="heroFile" class="bg-green-500 rounded px-2 py-1 text-white block">Uploading...</span>
                @if ($heroFile)
                    <img src="{{ Storage::url('group-files/'.$heroFile) }}">
                @endif
                @error('heroFile')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="m-2">
                <label class="block font-semibold">Project Video</label>
                <input wire:model="videoFile" type="file" class="rounded w-full mb-2">
                <span wire:loading wire:target="videoFile" class="bg-green-500 rounded px-2 py-1 text-white block">Uploading...</span>
                @error('videoFile')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="flex justify-evenly my-5">
                <button wire:click.prevent="$emit('closeUpdateModal')" class="rounded shadow-lg px-4 py-2 hover:bg-gray-100">Cancel</button>
                <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Submit</button>
            </div>
        </div>
    </form>
</div>
