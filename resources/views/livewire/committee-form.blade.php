<div>
    <h1 class="font-bold text-center text-3xl text-gray-800">Update Committee</h1>
    <form wire:submit.prevent="updateCommittee">
            <div class="m-2">
                <label class="block font-semibold text-gray-800">Committee Name</label>
                <input wire:model="name" type="text" class="rounded w-full">
                @error('name')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-evenly my-5">
                <button wire:click.prevent="$emit('closeUpdateModal')" class="rounded shadow-lg px-4 py-2 text-gray-800 hover:bg-gray-100">Cancel</button>
                <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Edit</button>
            </div>
        </div>
    </form>
</div>
