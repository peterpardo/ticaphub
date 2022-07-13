<div>
    @if($showModal)
    <x-modal>
        {{-- Form --}}
        <x-form wire:submit.prevent="saveCandidate">
            @if ($action === 'add')
                <x-form.title>Add Candidate</x-form.title>
            @else
                <x-form.title>Edit Candidate</x-form.title>
            @endif

            {{-- Search box --}}
            @if ($action === 'add')
                <x-form.form-control>
                    <x-form.input-info>
                        You can search for the student in the search box below.
                    </x-form.input-info>
                    <div class="relative">
                        <x-form.input wire:model="search" id="search" placeholder="Search student..." />
                        @if ($search !== '')
                            <div class="absolute border w-full rounded bg-white overflow-hidden max-h-40">
                                @forelse ($students as $student)
                                    <div class="px-2 py-1 hover:bg-gray-100 cursor-pointer" wire:click.prevent="selectStudent({{ $student->id }}, '{{ $student->fullname }}')">{{ $student->fullname }}</div>
                                @empty
                                    <div class="px-2 py-1">No student found</div>
                                @endforelse
                            </div>
                        @endif
                    </div>
                </x-form.form-control>
            @endif

            {{-- Student --}}
            <x-form.form-control>
                <x-form.label>Student Name</x-form.label>
                <div class="w-full py-2 px-3 rounded border border-gray-300 bg-gray-100 text-gray-500">
                    {{ ($name === '') ? 'Student name' : $name }}
                </div>
                @error('selectedStudentId')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
            </x-form.form-control>

            {{-- Position --}}
            <x-form.form-control>
                <x-form.label for="selectedPositionId">Position</x-form.label>
                <x-form.select wire:model="selectedPositionId" id="selectedPositionId">
                    <option value="">---select position---</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </x-form.select>
                @error('selectedPositionId')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
            </x-form.form-control>

            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                @if ($action === 'add')
                    <x-app.button color="green" type="submit">Add Candidate</x-app.button>
                @else
                    <x-app.button color="blue" type="submit">Edit Candidate</x-app.button>
                @endif
            </div>
        </x-form>
    </x-modal>
@endif
</div>
