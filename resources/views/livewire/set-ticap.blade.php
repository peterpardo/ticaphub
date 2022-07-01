<div>
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Set ticap button --}}
    <div class="flex items-center mx-auto w-96 h-96">
        <x-form wire:submit.prevent="setTicap">
            <x-form.form-control>
                <x-form.label>TICAP Name</x-form.label>
                <x-form.input-info>Please enter a unique TICAP name</x-form.input-info>
                <x-form.input wire:model="name" placeholder="e.g. TICaP v9.0"/>
                @error('name')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
            </x-form.control>
            <div class="text-right">
                <x-app.button color="green" type="submit">Set Ticap</x-app.button>
            </div>
        </x-form>
    </div>

    @if($showModal)
        <x-modal>
            <x-modal.title>Set TICAP</x-modal.title>
            <x-modal.description>Do you want to set the name as <strong>"{{ $name }}"</strong>?</x-modal.description>
            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                <x-app.button color="green" wire:click.prevent="confirmTicap">Yes, save it.</x-app.button>
            </div>
        </x-modal>
    @endif
</div>
