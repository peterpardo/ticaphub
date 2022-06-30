<div>
    @if ($showForm)
        <x-modal>
            @if ($action == 'add')
                <x-form.title>Add Adviser</x-form.title>
            @else
                <x-form.title>Update Adviser</x-form.title>
            @endif

            <x-form wire:submit.prevent="addAdviser">
                {{-- Adviser --}}
                <x-form.form-control>
                    <x-form.label for="adviser">Adviser Name</x-form.label>
                    <x-form.input-info>
                        <strong>Note:</strong> Please enter the <strong>fullname</strong> of the adviser. Also, include the title of the adviser (Mr., Ms., Dr., etc.)
                    </x-form.input-info>
                    <x-form.input wire:model="adviser" id="adviser" placeholder="e.g. Mr. John Doe"/>
                    @error('adviser')
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
