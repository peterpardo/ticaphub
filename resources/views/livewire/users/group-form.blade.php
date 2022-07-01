<div>
    @if ($showForm)
        <x-modal>
            @if ($action == 'add')
                <x-form.title>Add Group</x-form.title>
            @else
                <x-form.title>Update Group</x-form.title>
            @endif

            <x-form wire:submit.prevent="addGroup">
                {{-- School --}}
                <x-form.form-control>
                    <x-form.label for="selectedSchool">School</x-form.label>
                    <x-form.select wire:model="selectedSchool" id="selectedSchool">
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </x-form.select>
                    @error('selectedSchool')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Specialization --}}
                <x-form.form-control>
                    <x-form.label for="selectedSpecialization">Specialization</x-form.label>
                    <x-form.select wire:model="selectedSpecialization" id="selectedSpecialization">
                        <option value="" selected>---select specialization---</option>
                        @foreach($specializations as $specialization)
                            <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                        @endforeach
                    </x-form.select>
                    @error('selectedSpecialization')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Group --}}
                <x-form.form-control>
                    <x-form.label for="group">Group Name</x-form.label>
                    <x-form.input wire:model="group" id="group" placeholder="Enter group name..."/>
                    @error('group')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Adviser --}}
                <x-form.form-control>
                    <x-form.label for="selectedAdviser">Project Adviser</x-form.label>
                    <x-form.input-info>
                        <strong>Note:</strong>
                        If there is no adviser in the options, go to <strong>User Accounts > Project Advisers</strong> tab to add a new adviser.
                    </x-form.input-info>
                    <x-form.select wire:model="selectedAdviser" id="selectedAdviser">
                        <option value="">---select adviser---</option>
                        @foreach($advisers as $adviser)
                            <option value="{{ $adviser->id }}">{{ $adviser->name }}</option>
                        @endforeach
                    </x-form.select>
                    @error('selectedAdviser')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                <div class="text-right">
                    <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                    <x-app.button color="green" type="submit">Save</x-app.button>
                </div>
            </x-form>
        </x-modal>
    @endif
</div>
