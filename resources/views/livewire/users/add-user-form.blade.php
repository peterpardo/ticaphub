
<x-modal>
    <x-form.title>Add User</x-form.title>
    {{-- Form --}}
    <x-form wire:submit.prevent="addUser">
        {{-- Type --}}
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

            <hr class="full h-1 bg-gray-700">

            {{-- Group --}}
            <x-form.form-control>
                {{-- Alert message --}}
                @if ($groupStatus)
                    <x-alert.basic-alert color="green" message="Group successfully added."/>
                @endif
                <div class="mb-1">
                    <x-form.label for="newGroup">New Group (Optional)</x-form.label>
                    <span class="block py-1 px-2 rounded bg-gray-100 text-gray-500 text-xs">
                        <span class="font-bold">Note:</span>
                        You can create a new group for the <span class="font-bold italic">selected specialization</span> if it's empty or if the group you're searching for doesn't exists.
                    </span>
                </div>
                <x-form.input wire:model="newGroup" id="newGroup" placeholder="Enter group name here..."/>
                @error('newGroup')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
                <div class="text-right">
                    <x-app.button wire:loading.attr="disabled" color="blue" wire:click.prevent="addGroup">Add Group</x-app.button>
                </div>
            </x-form.form-control>

            <x-form.form-control>
                <x-form.label for="selectedGroup">Group</x-form.label>
                <x-form.select wire:model="selectedGroup" id="selectedGroup">
                    <option value="" selected>---select group---</option>
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
        <x-spinner wire:loading.flex wire:target="addUser, addGroup">Please Wait. This may take a few seconds</x-spinner>

        <div class="text-right">
            <x-app.button
                wire:loading.attr="disabled"
                color="gray"
                @click.prevent="showAddModal = false"
                wire:click.prevent="closeModal">
                Cancel
            </x-app.button>
            <x-app.button
                wire:loading.attr="disabled"
                color="green"
                type="submit">
                Add User
            </x-app.button>
        </div>
    </x-form>
</x-modal>



