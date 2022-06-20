
<x-modal>
    {{-- Form --}}
    <x-form wire:submit.prevent="addSpecialization">
        <x-form.title>Add Specialization</x-form.title>
        <x-form.form-control>
            <x-form.label for="selectedSchool">Select School</x-form.label>
            <x-form.select wire:model="selectedSchool" id="selectedSchool">
                @foreach($schools->where('is_involved') as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </x-form.select>
            @error('selectedSchool')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>

        <x-form.form-control>
            <x-form.label for="name">Specialization Name (Complete Name)</x-form.label>
            <x-form.input wire:model.lazy="name" id="name" placeholder="Ex: Web and Mobile Application" />
            @error('name')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>


        <div class="text-right">
            {{-- <x-app.button color="gray" wire:click.prevent="$emit('refreshParent')">Cancel</x-app.button> --}}
            <x-app.button color="gray" @click.prevent="showAddModal = false" wire:click.prevent="closeModal">Cancel</x-app.button>
            <x-app.button color="green" type="submit">Add Specialization</x-app.button>
        </div>
    </x-form>
</x-modal>



