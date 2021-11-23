<div>
    <form wire:submit.prevent='addList'>
        @csrf
        <label class="font-semibold block text-center">List Title</label>
        <input type="text" wire:model='title' class="rounded w-full mt-1 text-center" placeholder="Enter list">
        @error('title')
            <span class="inline-block w-full text-center rounded mt-1 bg-red-500 px-2 py-1 text-white">{{ $message }}</span>
        @enderror
        <div class="p-3 mt-2 text-center space-x-4 md:block">
            <a href="javascript;" wire:click.prevent="$emit('closeModal')" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
            <button type="submit" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Submit</button>
        </div>
    </form>
</div>
