<div>
    @if($showModal)
        <x-modal>
            {{-- Form --}}
            <x-form wire:submit.prevent="addPosition">
                <x-form.title>Add Position</x-form.title>

                <x-form.form-control>
                    <x-form.label for="name">Position Name</x-form.label>
                    <x-form.input wire:model="name" id="name" placeholder="Ex: Chairman" />
                    @error('name')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>


                <div class="text-right">
                    <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                    <x-app.button color="green" type="submit">Add Position</x-app.button>
                </div>
            </x-form>
        </x-modal>
    @endif
</div>
