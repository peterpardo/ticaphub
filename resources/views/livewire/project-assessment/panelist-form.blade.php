<div>
    @if($showModal)
        <x-modal>
            {{-- Form --}}
            <x-form wire:submit.prevent="savePanelist">
                @if ($action == 'add')
                    <x-form.title>Add Panelist</x-form.title>
                @else
                    <x-form.title>Edit Panelist</x-form.title>
                @endif

                {{-- Alert --}}
                @if (session('status'))
                    <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
                @endif

                {{-- Panelist --}}
                <x-form.form-control>
                    <x-form.label for="panelist">Panelist</x-form.label>
                    <x-form.input-info><strong>Note:</strong> If there are no listed panelist, go to <strong>User Accounts > Add User</strong> and add user as panelist.</x-form.input-info>
                    <x-form.select wire:model="panelist" id="panelist">
                        <option value="">--- select a panelist ---</option>
                        @foreach ($panelists as $panelist)
                            <option value="{{ $panelist->id }}">{{ $panelist->fullname }}</option>
                        @endforeach
                    </x-form.select>
                    @error('panelist')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                <div class="text-right">
                    <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                    <x-app.button color="green" type="submit">Save changes</x-app.button>
                </div>
            </x-form>
        </x-modal>
    @endif
</div>
