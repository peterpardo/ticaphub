
<div>
    @if ($showForm)
        <x-modal>
            @if ($action == 'update')
                <x-form.title>Update User</x-form.title>
            @else
                <x-form.title>Add User</x-form.title>
            @endif

            {{-- Form --}}
            <x-form wire:submit.prevent="addUser">
                {{-- Type --}}
                {{-- Hide selecting of role if action is update --}}
                @if ($action != 'update')
                    <x-form.form-control>
                        <x-form.label for="role">Role</x-form.label>
                        <x-form.select wire:model="role" id="role">
                            <option value="">---select role---</option>
                            <option value="student">Student</option>
                            <option value="panelist">Panelist</option>
                            <option value="admin">Admin</option>
                        </x-form.select>
                        @error('role')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </x-form.form-control>
                @endif

                {{-- Email --}}
                <x-form.form-control>
                    <x-form.label for="email">Email</x-form.label>
                    <x-form.input wire:model.lazy="email" id="email" />
                    @error('email')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- First name --}}
                <x-form.form-control>
                    <x-form.label for="fname">First Name</x-form.label>
                    <x-form.input wire:model.lazy="fname" id="fname" />
                    @error('fname')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Last name --}}
                <x-form.form-control>
                    <x-form.label for="lname">Last Name</x-form.label>
                    <x-form.input wire:model.lazy="lname" id="lname" />
                    @error('lname')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Show if selected role is student --}}
                @if ($showStudentFields)
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
                        <x-form.label for="selectedGroup">Group</x-form.label>
                        <x-form.input-info>
                            <strong>Note:</strong>
                            If there is no group for this specialization, go to <strong>User Accounts > Groups</strong> tab to create a new group.
                        </x-form.input-info>
                        <x-form.select wire:model="selectedGroup" id="selectedGroup">
                            <option value="">---select group---</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </x-form.select>
                        @error('selectedGroup')
                            <x-form.error>{{ $message }}</x-form.error>
                        @enderror
                    </x-form.form-control>
                @endif

                {{-- Spinner --}}
                <x-spinner wire:loading.flex wire:target="addUser">Please Wait. This may take a few seconds</x-spinner>

                <div class="text-right">
                    <x-app.button color="gray" wire:loading.attr="disabled" wire:click.prevent="closeModal">Cancel</x-app.button>
                    <x-app.button color="green" wire:loading.attr="disabled" type="submit">Save</x-app.button>
                </div>
            </x-form>
        </x-modal>
    @endif
</div>



