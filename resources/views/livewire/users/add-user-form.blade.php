
<x-modal>
    <x-form.title>Add User</x-form.title>
    {{-- Form --}}
    <x-form wire:submit.prevent="addUser">
        {{-- Type --}}
        <x-form.form-control>
            <x-form.label for="role">Type</x-form.label>
            <x-form.select wire:model="role" id="role">
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
            <x-form.input wire:model="email" id="email" />
            @error('email')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>

        {{-- First name --}}
        <x-form.form-control>
            <x-form.label for="fname">First Name</x-form.label>
            <x-form.input wire:model="fname" id="fname" />
            @error('fname')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>

        {{-- Last name --}}
        <x-form.form-control>
            <x-form.label for="lname">Last Name</x-form.label>
            <x-form.input wire:model="lname" id="lname" />
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

             {{-- Adviser/Mentor --}}
             <x-form.form-control>
                {{-- Alert message --}}
                @if ($adviserStatus)
                    <x-alert.basic-alert color="green" message="Adviser successfully added."/>
                @endif
                <div class="mb-1">
                    <x-form.label for="newAdviser">New Adviser/Mentor (Optional)</x-form.label>
                    <span class="block py-1 px-2 rounded bg-gray-100 text-gray-500 text-xs">
                        <span class="font-bold">Note:</span>
                        You can add a new adviser if the options are empty or if the adviser you're searching for doesn't exists. Please enter complete name.
                    </span>
                </div>
                <x-form.input wire:model="newAdviser" id="newAdviser" placeholder="e.g. John Doe"/>
                @error('newAdviser')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
                <div class="text-right">
                    <x-app.button color="blue" wire:click.prevent="addAdviser">Add Adviser</x-app.button>
                </div>
            </x-form.form-control>

            <x-form.form-control>
                <x-form.label for="selectedAdviser">Group Adviser/Mentor</x-form.label>
                <x-form.select wire:model="selectedAdviser" id="selectedAdviser">
                    <option value="" selected>---select adviser---</option>
                    @foreach($advisers as $adviser)
                        <option value="{{ $adviser->id }}">{{ $adviser->name }}</option>
                    @endforeach
                </x-form.select>
                @error('selectedAdviser')
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
                    <x-app.button color="blue" wire:click.prevent="addGroup">Add Group</x-app.button>
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

        <div class="text-right">
            <x-app.button
                color="gray"
                @click.prevent="showAddModal = false"
                wire:click.prevent="closeModal">
                Cancel
            </x-app.button>
            <x-app.button
                color="green"
                type="submit">
                Add User
            </x-app.button>
        </div>
    </x-form>
</x-modal>



