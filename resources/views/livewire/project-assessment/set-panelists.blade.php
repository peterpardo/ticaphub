<div class="space-y-2">
    {{-- Specialization name --}}
    <div class="flex flex-col gap-y-2 md:flex-row md:justify-between md:items-center">
        <h1 class="font-bold text-xl">{{ $specialization->school->name }} | {{ $specialization->name }}</h1>

        <div class="flex gap-x-1 self-end md:self-auto">
            <x-app.button type="link" href="{{ url('project-assessment/' . $specialization->id) }}" color="gray">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                Awards
            </x-app.button>
            <x-app.button type="link" href="{{ url('project-assessment/review-settings/' . $specialization->id) }}" color="indigo">
                Review Settings
                <i class="fa-solid fa-arrow-right ml-1"></i>
            </x-app.button>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can set panelists for this specialization. A panelist can be assigned to multiple specializations.
    </x-info-box>

    {{-- Add panelist --}}
    <x-app.button color="green" wire:click.prevent="$emitTo('project-assessment.panelist-form', 'showModal', 'add')">
        <i class="fa-solid fa-plus mr-1"></i>
        Add Panelist
    </x-app.button>

    {{-- Panelists Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>Panelist Name</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($panelists as $panelist)
                <tr>
                    <x-table.tdata>{{ $panelist->user->fullname }}</x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.delete-btn wire:click="selectItem({{ $panelist->id }})"/>
                        <x-table.edit-btn type="button" wire:click.prevent="$emitTo('project-assessment.panelist-form', 'showModal', 'edit', {{ $panelist->id }})"/>
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No panelists are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links"></x-slot>
    </x-table>

    {{-- Modals --}}
    {{-- Add panelist --}}
    <livewire:project-assessment.panelist-form :specializationId="$specialization->id"/>

    {{-- Delete panelist --}}
    <div x-cloak x-show="showDeleteModal">
        <x-modal>
            <x-modal.title>Delete Panelist</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently delete the panelist.</x-modal.description>

            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                <x-app.button color="red" wire:click.prevent="deleteItem">Yes, delete panelist.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
