<div>
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <div class="bg-yellow-100 py-5 px-6 rounded-lg text-sm text-yellow-600 mb-3">
        <span class="font-bold">Note:</span> You can set the TICAP settings here, which schools are involved, and what specializations are included in each school.
    </div>

    <div class="flex flex-col-reverse justify-between sm:flex-row">
        <div class="flex flex-col mb-3 space-y-2 sm:flex-row sm:items-center sm:space-y-0">
            <h1 class="inline-block text-2xl font-bold mr-3">Schools</h1>
            <span class="inline-block px-2 py-.5 bg-gray-100 rounded text-sm text-gray-500">Check the box to include the school</span>
        </div>

        {{-- Confirm Button --}}
        <div class="self-end mb-2 sm:self-auto sm:mb-0">
            <button type="button" wire:click="openModal('confirm')" class="p-2 text-sm text-white rounded-lg bg-blue-600 hover:bg-blue-500">Confirm Settings</button>
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
        <h2 class="inline-block text-2xl font-bold mr-2">Specializations</h2>
        <span class="inline-block px-2 py-.5 bg-gray-100 rounded text-sm text-gray-500">Add specializations for each school</span>
    </div>

    {{-- Specialization Form --}}
    <form wire:submit.prevent="addSpecialization" class="space-y-3 w-full max-w-xs">
        <div class="flex flex-col space-y-1">
            <label for="selectedSchool" class="text-sm tracking-wide">Select School</label>
            <select wire:model="selectedSchool" id="selectedSchool" class="w-full py-2 px-3 rounded border border-gray-500 text-sm">
                @foreach($schools->where('is_involved', 1) as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </select>
            {{-- Error message --}}
            @error('selectedSchool')
                <span class="text-sm tracking-wide bg-red-100 text-red-500 rounded-lg py-1 px-3">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col space-y-1">
            <label for="name" class="text-sm tracking-wide">Specialization Name (Complete Name)</label>
            <input type="text" wire:model.defer="name" id="name" class="w-full py-2 px-3 rounded border border-gray-500 text-sm" placeholder="Ex: Web and Mobile Application" autocomplete="off">
            {{-- Error message --}}
            @error('name')
                <span class="text-sm tracking-wide bg-red-100 text-red-500 rounded-lg py-1 px-3">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="p-2 text-sm text-white rounded-lg bg-green-600 hover:bg-green-500">Add Specialization</button>
    </form>

    {{-- Specialization Table --}}
    <x-table>
        <x-slot name="heading">
           <x-table.thead>school</x-table.thead>
           <x-table.thead>specialization</x-table.thead>
           <x-table.thead>actions</x-table.thead>
        </x-slot>

        <x-slot name="body">
            @forelse ($specializations as $specialization)
                <tr>
                    <x-table.tdata>{{ $specialization->school->name }}</x-table.tdata>
                    <x-table.tdata>{{ $specialization->name }}</x-table.tdata>
                    <x-table.tdata-actions>
                        <x-table.delete-btn wire:click="openModal('delete', {{ $specialization->id }})"   />
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>{{ $specialization->school->name }}</x-table.tdata>
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
            <x-slot name="title">
                Delete Specialization
            </x-slot>
            <x-slot name="description">
                Are you sure? Continuing this will permanently delete the specialization.
            </x-slot>
        </x-modal.delete-modal>
    @endif

    {{-- Confirm modal --}}
    @if ($showConfirmModal)
        <x-modal.confirm-modal>
            <x-slot name="title">
                TICAP Settings
            </x-slot>

            <x-slot name="content">
                <p class="text-sm text-gray-500 px-8 mb-5">Do you want to start the TICaP with these settings?
                    You will not be able to change it once you proceed.</p>
                <table class="w-full border-collapse border border-black">
                    <thead>
                        <tr>
                            <th class="border-black border">School</th>
                            <th class="border-black border">No. of Specializations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schools as $school)
                            @if ($school->is_involved)
                                <tr>
                                    <td class="border-black border">{{ $school->name }}</td>
                                    <td class="border-black border">{{ $school->specializations_count }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </x-slot>
        </x-modal.confirm-modal>
    @endif
</div>
