
<div>
    @if ($showForm)
        <x-modal>
            <x-form.title>Add User</x-form.title>

            {{-- Form --}}
            <x-form wire:submit.prevent="saveUser">
                {{-- Note --}}
                @if (auth()->user()->hasRole('superadmin'))
                    <x-info-box color="yellow">
                        You can uncheck the "<strong>send invitation email</strong>" checkbox to automatically verify the account upon creation. By default, the password of the created account will be <strong>ticaphub123</strong>. Notify the user to change the password upon logging in.
                    </x-info-box>
                @endif

                {{-- Type --}}
                <x-form.form-control>
                    <x-form.label for="role">Role</x-form.label>
                    <x-form.select wire:model="role" id="role">
                        <option value="">---select role---</option>
                        <option value="student">Student</option>
                        <option value="panelist">Panelist</option>
                        {{-- Only allow superadmin to add other admins --}}
                        @if (auth()->user()->hasRole('superadmin'))
                            <option value="admin">Admin</option>
                        @endif
                    </x-form.select>
                    @error('role')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Invitation email --}}
                <x-form.form-control>
                    <x-form.label for="role">Invitation Email</x-form.label>
                    <div class="flex items-center space-x-2">
                        <input
                            type="checkbox"
                            wire:model="isSendEmail"
                            id="isSendEmail"
                            class="rounded appearance-none checked:bg-blue-600 checked:border-transparent">
                        <label for="isSendEmail">send invitation email</label>
                    </div>
                </x-form.form-control>

                {{-- Email --}}
                <x-form.form-control>
                    <x-form.label for="email">Email</x-form.label>
                    <x-form.input-info><strong>Note:</strong> This email will be used to send an invitation to confirm the account.</x-form.input-info>
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
                <x-spinner wire:loading.flex wire:target="saveUser">Please Wait. This may take a few seconds</x-spinner>

                <div class="text-right">
                    <x-app.button color="gray" wire:loading.attr="disabled" wire:click.prevent="closeModal">Cancel</x-app.button>
                    <x-app.button color="green" wire:loading.attr="disabled" type="submit">Save</x-app.button>
                </div>
            </x-form>
        </x-modal>
    @endif
</div>



