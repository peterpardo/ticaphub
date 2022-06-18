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
           <x-app.button color="blue">Confirm Settings</x-app.button>
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
    <x-form wire:submit.prevent="addSpecialization">
        <x-form.form-control>
            <x-form.label for="selectedSchool">Select School</x-form.label>
            <x-form.select wire:model="selectedSchool" id="selectedSchool">
                @foreach($schools->where('is_involved', 1) as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </x-form.select>
            {{-- Error message --}}
            @error('selectedSchool')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>
        <x-form.form-control>
            <x-form.label for="name">Specialization Name (Complete Name)</x-form.label>
            <x-form.input wire:model.defer="name" id="name" placeholder="Ex: Web and Mobile Application" />
            {{-- Error message --}}
            @error('name')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>
        <div class="text-right">
            <x-app.button color="green" type="submit">Add Specialization</x-app.button>
        </div>
    </x-form>

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
