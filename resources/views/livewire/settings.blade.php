<div x-data="{
    showModal: @entangle('showModal').defer,
}">
    {{-- Navbar --}}
    @include('settings.navbar')

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can update the name of the TICaP event. Also, you can end the current TICaP and create a new one.
    </x-info-box>

    <div class="space-y-2 mt-5 max-w-2xl">
        {{-- Change TICaP name --}}
        <div class="flex flex-col items-start gap-y-2 border-b-2 border-gray-300 w-full pb-5 md:flex-row md:items-center md:justify-between">
            <div class="space-y-2">
                <span class="block font-bold">Change TICaP name</span>
                <span class="block text-xs">The current TICaP name is <strong>"{{ $ticap->name }}"</strong></span>
            </div>
            <div class="self-end md:self-auto">
                <x-app.button color="blue" wire:click.prevent="$emitTo('settings.ticap-form', 'getTicap', {{ $ticap->id }})">
                    <i class="fa-solid fa-pen mr-1"></i>
                    Change name
                </x-app.button>
            </div>
        </div>

        {{-- Reset Ticap --}}
        <div class="flex flex-col items-start gap-y-2 border-b-2 border-gray-300 w-full pb-5 md:flex-row md:items-center md:justify-between">
            <div class="space-y-2">
                <span class="block font-bold">End current TICaP</span>
                <span class="block text-xs w-full max-w-md">Once you end the event, all of the users in the event will be deleted and all of the necessary data will be stored in the <strong>Documentation</strong> tab.</span>
            </div>
            <div class="self-end md:self-auto">
                <x-app.button color="red" wire:click.prevent="$set('showModal', true)">
                    <i class="fa-solid fa-trash mr-1"></i>
                    End event
                </x-app.button>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    {{-- Edit Ticap --}}
    @livewire('settings.ticap-form')

    {{-- Reset TICaP --}}
    <div x-cloak x-show="showModal">
        <x-modal>
            <x-modal.title>End Event</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently end the event.</x-modal.description>

            {{-- Spinner --}}
            <x-spinner wire:loading.flex wire:target="endEvent">Please wait. This may take a few seconds...</x-spinner>

            <div class="text-right">
                <x-app.button color="gray" wire:loading.attr="disabled" wire:click.prevent="$set('showModal', false)">Cancel</x-app.button>
                <x-app.button color="red" wire:loading.attr="disabled" wire:click.prevent="endEvent">Yes, end the event.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
