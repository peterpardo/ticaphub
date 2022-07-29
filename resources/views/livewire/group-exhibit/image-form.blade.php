<div>
    @if($showModal)
        <x-modal>
            {{-- Form --}}
            <x-form wire:submit.prevent="updateImage">
                @if ($action === 'hero')
                    <x-form.title>Edit Hero Image</x-form.title>
                @else
                    <x-form.title>Edit Poster Image</x-form.title>
                @endif

                <x-form.form-control>
                    <x-form.label for="image">
                        @if ($action == 'hero')
                            Hero Image
                        @else
                            Poster Image
                        @endif
                    </x-form.label>
                    <input type="file" wire:model="image"/>
                    @error('image')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>


                <div class="text-right">
                    <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                    <x-app.button color="blue" type="submit">Save changes</x-app.button>
                </div>
            </x-form>
        </x-modal>
    @endif
</div>
