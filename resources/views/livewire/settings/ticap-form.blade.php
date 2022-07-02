<div>
   @if($showForm)
        <x-modal>
            <x-form.title>Change TICaP Name</x-form.title>

            {{-- Form --}}
            <x-form wire:submit.prevent="updateTicap">
                {{-- Name --}}
                <x-form.form-control>
                    <x-form.label>TICaP name</x-form.label>
                    <x-form.input wire:model="name"/>
                    @error('name')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                <div class="text-right">
                    <x-app.button color="gray" wire:loading.attr="disabled" wire:click.prevent="closeModal">Cancel</x-app.button>
                    <x-app.button color="green" wire:loading.attr="disabled" type="submit">Save</x-app.button>
                </div>
            </x-form>
        </x-modal>
    @endif
</div>
