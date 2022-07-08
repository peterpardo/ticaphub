<div class="space-y-5 w-full max-w-screen-sm mx-auto">
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
        class="flex flex-col items-center gap-y-2 pb-5 border-b-2 border-gray-300 lg:flex-row lg:items-start">
            <div class="flex-1 w-40">
                <div class="w-40 h-40 mx-auto rounded-full overflow-hidden object-cover">
                    {{-- Check if user has a profile picture --}}
                    <img
                        class="w-full"
                        @if (is_null($user->profile_picture))
                            src="{{ url(asset('assets/default-img.png')) }}"
                        @else
                            src="{{ url(asset($user->profile_picture)) }}"
                        @endif
                        alt="profile_picture"
                        loading="lazy" />
                </div>
            </div>

            <div class="flex-1 space-y-1">
                <p class="font-bold">{{ $user->fullname }}</p>
                <p class="text-gray-400">{{ $user->email }}</p>
                @if ($user->getRoleNames()->first() === 'student')
                    <span class="bg-indigo-100 text-indigo-400 rounded-lg inline-block px-2 py-1 text-sm">{{ $user->getRoleNames()->first() }}</span>
                @elseif ($user->getRoleNames()->first() === 'panelist')
                    <span class="bg-yellow-100 text-yellow-400 rounded-lg inline-block px-2 py-1 text-sm">{{ $user->getRoleNames()->first() }}</span>
                @else
                    <span class="bg-blue-100 text-blue-400 rounded-lg inline-block px-2 py-1 text-sm">{{ $user->getRoleNames()->first() }}</span>
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

            @hasanyrole('superadmin|admin')
                {{-- Permissions --}}
                <x-form.form-control>
                    <x-form.label>Permissions</x-form.label>
                    <div class="grid grid-rows-2 grid-cols-1 md:grid-cols-2 gap-y-2">
                        <div class="flex items-center space-x-2 text-sm">
                            <input
                            type="checkbox"
                            wire:model="uaPermission"
                            id="uaPermission"
                            class="rounded appearance-none checked:bg-blue-600 checked:border-transparent">
                            <label for="uaPermission">give accesss <strong>User Accounts</strong></label>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <input
                            type="checkbox"
                            wire:model="paPermission"
                            id="paPermission"
                            class="rounded appearance-none checked:bg-blue-600 checked:border-transparent">
                            <label for="paPermission">give access <strong>Project Assessment</strong></label>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <input
                            type="checkbox"
                            wire:model="chPermission"
                            id="chPermission"
                            class="rounded appearance-none checked:bg-blue-600 checked:border-transparent">
                            <label for="chPermission">give access <strong>Committee Heads</strong></label>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <input
                            type="checkbox"
                            wire:model="mePermission"
                            id="mePermission"
                            class="rounded appearance-none checked:bg-blue-600 checked:border-transparent">
                            <label for="mePermission">give access <strong>Manage Events</strong></label>
                        </div>
                    </div>
                </x-form.form-control>
            @endhasanyrole
        @endif

        <div class="text-right">
            <x-app.button type="submit" color="green">Save Changes</x-app.button>
        </div>
    </x-form>
</div>
