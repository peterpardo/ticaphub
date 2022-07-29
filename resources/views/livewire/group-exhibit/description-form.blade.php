<div>
    @if ($showModal)
        <x-modal>
            <x-form wire:submit.prevent="updateDescription">
                <x-form.title>Edit Project Description</x-form.title>

                {{-- Title --}}
                <x-form.form-control>
                    <x-form.label for="title">Title</x-form.label>
                    <x-form.input-info>
                        In here, type in the title of your Capstone Project.
                    </x-form.input-info>
                    <x-form.input wire:model.lazy="title" id="title" />
                    @error('title')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Description --}}
                <x-form.form-control>
                    <x-form.label for="description">Description</x-form.label>
                    <x-form.input-info>
                        <strong>Note:</strong>
                        The description must not be greater than 200 words.
                    </x-form.input-info>
                    <textarea class="w-full py-2 px-3 rounded border border-gray-300" style="min-height: 300px" wire:model.lazy="description" id="description"></textarea>
                    @error('description')
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
