<div class="space-y-5 w-full mx-auto" style="max-width: 600px">
    <x-app.button type="link" color="red" href="{{ url('users') }}" >
        <i class="fa-solid fa-arrow-left mr-2"></i>
        Go back
    </x-app.button>

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    <h1 class="text-2xl font-bold pb-2 border-b-2 border-gray-300">Edit User</h1>

    <x-form wire:submit.prevent="updateUser">
        <div
        class="flex flex-col items-center gap-y-2
        lg:flex-row lg:items-start">
            <div class="flex-1 w-40">
                <img class="w-40 mx-auto rounded-full"
                src="{{ is_null($user->profile_picture) ? url(asset('assets/default-img.png')) : Storage::url($user->profile_picture)}}"
                alt="profile_picture" />
            </div>

            <div class="flex-1 space-y-1">
                <p class="font-bold">{{ $user->fullname }}</p>
                <p class="text-gray-400">{{ $user->email }}</p>
                @if ($user->getRoleNames()->first() === 'student')
                    <span class="bg-indigo-500 text-white rounded-lg inline-block px-2 py-1 text-sm">{{ $user->getRoleNames()->first() }}</span>
                @elseif ($user->getRoleNames()->first() === 'panelist')
                    <span class="bg-yellow-500 text-white rounded-lg inline-block px-2 py-1 text-sm">{{ $user->getRoleNames()->first() }}</span>
                @else
                    <span class="bg-blue-500 text-white rounded-lg inline-block px-2 py-1 text-sm">{{ $user->getRoleNames()->first() }}</span>
                @endif
            </div>
        </div>

        <div
            class="flex flex-col gap-y-2
            lg:flex-row lg:gap-x-2">
            {{-- First name --}}
            <x-form.form-control class="flex-1">
                <x-form.label>First Name</x-form.label>
                <x-form.input wire:model="fname"/>
                @error('fname')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
            </x-form.form-control>

            {{-- Last nmae --}}
            <x-form.form-control class="flex-1">
                <x-form.label>Last Name</x-form.label>
                <x-form.input wire:model="lname"/>
                @error('lname')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
            </x-form.form-control>
        </div>

        {{-- Middle name --}}
        <x-form.form-control>
            <x-form.label>Middle Name <span class="text-sm text-gray-300">(Optional)</span></x-form.label>
            <x-form.input wire:model="mname"/>
            @error('mname')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>

        {{-- Email --}}
        <x-form.form-control>
            <x-form.label>Email</x-form.label>
            <x-form.input wire:model="email"/>
            @error('email')
                <x-form.error>{{ $message }}</x-form.error>
            @enderror
        </x-form.form-control>

        @if($showStudentFields)
            {{-- School --}}
            <x-form.form-control>
                <x-form.label>School</x-form.label>
                <x-form.select wire:model="selectedSchool">
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
                <x-form.label>Specialization</x-form.label>
                <x-form.select wire:model="selectedSpecialization">
                    <option value="">---select specialization---</option>
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
                <x-form.label>Group</x-form.label>
                <x-form.input-info>
                    <strong>Note:</strong>
                    If there is no group for this specialization, go to <strong>User Accounts > Groups</strong> tab to create a new group.
                </x-form.input-info>
                <x-form.select wire:model="selectedGroup">
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

        <x-form.form-control>
            <x-form.label>Permissions</x-form.label>
            <div class="flex gap-x-4">
                <div class="flex items-center space-x-2">
                    <input
                    type="checkbox"
                    class="rounded appearance-none checked:bg-blue-600 checked:border-transparent">
                    <label for="alabang">First Permission</label>
                </div>
                <div class="flex items-center space-x-2">
                    <input
                    type="checkbox"
                    class="rounded appearance-none checked:bg-blue-600 checked:border-transparent">
                    <label for="alabang">Second Permission</label>
                </div>
            </div>
        </x-form.form-control>

        <div class="text-right">
            <x-app.button type="submit" color="green">Save Changes</x-app.button>
        </div>
    </x-form>
</div>
