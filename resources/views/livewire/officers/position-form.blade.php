<div>
    @if($showModal)
        <x-modal>
            {{-- Form --}}
            <x-form wire:submit.prevent="addPosition">
                @if ($action === 'add')
                    <x-form.title>Add Position</x-form.title>
                @else
                    <x-form.title>Edit Position</x-form.title>
                @endif

                <x-form.form-control>
                    <x-form.label for="name">Position Name</x-form.label>
                    <x-form.input wire:model="name" id="name" placeholder="Ex: Chairman" />
                    @error('name')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>


                <div class="text-right">
                    <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                    @if ($action === 'add')
                        <x-app.button color="green" type="submit">Add Position</x-app.button>
                    @else
                        <x-app.button color="blue" type="submit">Edit Position</x-app.button>
                    @endif
                </div>
            </x-form>
        </x-modal>
    @endif
</div>
