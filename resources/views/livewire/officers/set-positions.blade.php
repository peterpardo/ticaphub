<div class="space-y-4"  x-data="{
    showDeleteModal: @entangle('showDeleteModal').defer,
}">
    {{-- Election name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $election->name }}</h1>

        <div class="self-end md:self-auto">
            <x-app.button type="link" href="{{ url('officers/set-candidates/' . $election->id) }}" color="indigo">
                Set Candidates
                <i class="fa-solid fa-arrow-right-from-bracket ml-1"></i>
            </x-app.button>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        For the first step, create positions (e.g. Chairman, Committee Head, etc.) for this election. Make sure to finish this step to be able to nominate students as candidate for the selected position.
    </x-info-box>

    {{-- Add Position Button --}}
    <div class="space-y-1">
        <h2 class="text-lg font-semibold">Set Position</h2>
        <x-app.button color="green" wire:click.prevent="$emitTo('officers.position-form', 'showModal')">
            <i class="fa-solid fa-plus mr-1"></i>
            Add Position
        </x-app.button>
    </div>

    {{-- Positions Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>Position</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($positions as $position)
                <tr>
                    <x-table.tdata>{{ $position->name }}</x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.delete-btn wire:click="selectItem({{ $position->id }})"/>
                        <x-table.edit-btn type="button" wire:click.prevent="$emitTo('officers.position-form', 'getPosition', {{ $position->id }})"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No Positions are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $positions->links() }}
        </x-slot>
    </x-table>

    {{-- Modals --}}
    {{-- Add position --}}
    @livewire('officers.position-form', ['electionId' => $election->id])

    {{-- Delete position --}}
    <div x-cloak x-show="showDeleteModal">
        <x-modal>
            <x-modal.title>Delete Position</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently delete the position.</x-modal.description>
            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                <x-app.button color="red" wire:click.prevent="deleteItem">Yes, delete it.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
