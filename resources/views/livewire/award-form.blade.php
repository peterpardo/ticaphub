<div>
    <form wire:submit.prevent="addAward">
        <div class="flex flex-col">
            <div class="m-2">
                <label class="block font-semibold">Award Name</label>
                <input wire:model="name" type="text" class="rounded w-full">
                @error('name')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="m-2">
                <label class="block font-semibold">Award Type</label>
                <select wire:model="type" class="rounded w-full">
                    <option value="">-- select type --</option>
                    <option value="individual">Individual</option>
                    <option value="group">Group</option>
                </select>
                @error('type')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="m-2">
                <label class="block font-semibold">School</label>
                <select wire:model="selectedSchool" class="rounded w-full">
                    <option value="">-- select school --</option>
                    @foreach($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
                @error('selectedSchool')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            @if($selectedSchool != null)
            <div class="m-2">
                <label class="block font-semibold">Specialization</label>
                <select wire:model="selectedSpec" class="rounded w-full">
                    <option value="">-- select specialization --</option>
                    @foreach($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                    @endforeach
                </select>
                @error('selectedSpec')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            @endif
            <div class="text-center">
                <button wire:click.prevent="$emit('closeAwardForm')" class="rounded shadow-lg px-4 py-2 hover:bg-gray-100">Cancel</button>
                <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Submit</button>
            </div>
        </div>
    </form>
</div>
