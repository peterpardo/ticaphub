<div>
    @if ($showForm)
    <x-modal>
        {{-- Form --}}
        <x-form wire:submit.prevent="updateSpecialization">
            <x-form.title>Edit Specialization</x-form.title>
            <x-form.form-control>
                <x-form.label for="selectedSchool">School</x-form.label>
                <span>{{ $school }}</span>
            </x-form.form-control>

            <x-form.form-control>
                <x-form.label for="name">Specialization Name</x-form.label>
                <x-form.input-info><strong>Note:</strong> Please enter the complete name of the specialization</x-form.input-info>
                <x-form.input wire:model="name" id="name" placeholder="Ex: Web and Mobile Application" />
                @error('name')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
            </x-form.form-control>

            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                <x-app.button color="green" type="submit">Save</x-app.button>
            </div>
        </x-form>
    </x-modal>
    @endif
</div>
