<div>
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        You can set the TICAP settings here, which schools are involved, and what specializations are included in each school.
    </x-info-box>

    <div class="flex flex-col-reverse justify-between sm:flex-row">
        <div class="flex flex-col mb-3 space-y-2 sm:flex-row sm:items-center sm:space-y-0">
            <x-title>Schools</x-title>
            <x-title-info>Check the box to include the school</x-title-info>
        </div>

        {{-- Confirm Button --}}
        <div class="self-end mb-2 sm:self-auto sm:mb-0">
           <x-app.button wire:click="openModal('confirm')" color="blue">Confirm Settings</x-app.button>
        </div>
    </div>

    {{-- Schools --}}
    <div class="flex flex-col w-full space-y-2">
        @foreach ($schools as $school)
            @if ($school->id !== 1)
                <div class="flex items-center space-x-2">
                    <input
                        type="checkbox"
                        @if($school->is_involved)
                            checked
                        @endif
                        wire:click.prevent="changeSchoolStatus({{ $school->is_involved }}, {{ $school->id }})"
                        id="{{ $school->slug_name  }}"
                        class="rounded appearance-none checked:bg-blue-600 checked:border-transparent">
                    <label for="{{ $school->slug_name  }}">{{ $school->name }}</label>
                </div>
            @endif
        @endforeach
    </div>

    <hr class="my-3 h-1 rounded-lg bg-gray-100">

    {{-- Specializations --}}
    <div class="flex flex-col mb-3 space-y-2 sm:flex-row sm:items-center sm:space-y-0">
        <x-title>Specializations</x-title>
        <x-title-info>Add specializations for each school</x-title-info>
    </div>

    {{-- Add Specialization --}}
    <x-app.button color="green" wire:click="openModal('add')">Add Specialization</x-app.button>
    @if ($showFormModal)
        @livewire('users.add-specialization-form', ['schools' => $schools])
    @endif


    {{-- Specialization Table --}}
    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>school</x-table.thead>
                <x-table.thead>specialization</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($specializations as $specialization)
                @if($specialization->school->is_involved)
                    <tr>
                        <x-table.tdata>{{ $specialization->school->name }}</x-table.tdata>
                        <x-table.tdata>{{ $specialization->name }}</x-table.tdata>
                        <x-table.tdata-actions>
                            <x-table.delete-btn wire:click="openModal('delete', {{ $specialization->id }})"   />
                        </x-table.tdata-actions>
                    </tr>
                @endif
            @empty
                <tr>
                    <x-table.tdata>No Specializations are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $specializations->links() }}
        </x-slot>
    </x-table>


    {{-- Delete modal --}}
    {{-- NOTE: This modal can only be used inside a livewire component --}}
    @if ($showDeleteModal)
        <x-modal.delete-modal>
            <x-modal.title>Delete Specialization</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently delete the specialization.</x-modal.description>
        </x-modal.delete-modal>
    @endif

    {{-- Confirm modal --}}
    @if ($showConfirmModal)
        <x-modal.confirm-modal>
            <x-modal.title>TICAP Settings</x-modal.title>
            <x-modal.description>Do you want to start the TICaP with these specializations? You will not be able to change it once you proceed.</x-modal.description>

            <x-modal.table>
                <x-slot name="heading">
                    <x-modal.table.thead>School</x-modal.table.thead>
                    <x-modal.table.thead>Specializations</x-modal.table.thead>
                </x-slot>

                <x-slot name="body">
                    @foreach ($schools->where('is_involved', 1) as $school)
                        <tr>
                            <x-modal.table.tdata>{{ $school->name }}</x-modal.table.tdata>
                            <x-modal.table.tdata>{{ $school->specializations_count}}</x-modal.table.tdata>
                        </tr>
                    @endforeach
                </x-slot>
            </x-modal.table>
        </x-modal.confirm-modal>
    @endif
</div>
