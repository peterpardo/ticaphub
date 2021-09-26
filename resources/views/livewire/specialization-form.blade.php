<div>
    <h1 class="font-bold text-center text-3xl">Update Specialization</h1>
    <form wire:submit.prevent="updateSpec">
        <div class="flex flex-col">
            <div class="m-2">
                <label class="block font-semibold">School</label>
                <select wire:model="selectedSchool" class="rounded block w-full">
                    @foreach($involvedSchools as $involvedSchool) 
                    <option value="{{ $involvedSchool->id }}">{{ $involvedSchool->name }}</option>
                    @endforeach
                </select>
                @error('selectedSchool')
                <span class='block bg-red-500 text-white rounded mt-2 px-2 py-1'>{{ $message }}</span>
                @enderror
            </div>
            <div class="m-2">
                <label class="block font-semibold">Specialization Name</label>
                <input wire:model="specialization" type="text" class="rounded w-full">
                @error('specialization')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-evenly my-5">
                <button wire:click.prevent="$emit('closeSpecForm')" class="rounded shadow-lg px-4 py-2 hover:bg-gray-100">Cancel</button>
                <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Submit</button>
            </div>
        </div>
    </form>
</div>
