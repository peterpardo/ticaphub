<div class="space-y-4">
    <h1 class="font-bold text-xl">{{ $election->name }}</h1>

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        For the first step, create positions (e.g. Chairman, Committee Head, etc.) for this election. Make sure to finish this step to be able to nominate students as candidate for the selected position.
    </x-info-box>

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
                        <x-table.delete-btn />
                        <x-table.edit-btn type="button"/>
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
</div>
