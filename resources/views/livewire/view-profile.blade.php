<div class="space-y-5 w-full max-w-screen-sm mx-auto">
    {{-- {{ dd(Storage::url($user->profile_picture)) }} --}}

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    <h1 class="text-2xl font-bold pb-2 border-b-2 border-gray-300">Your Profile</h1>

    {{-- Note --}}
    @role('student')
        <x-info-box color="yellow">
            Here, you can update your name and profile picture. Contact an admin in case you want to change your email, school and specialization, or what group you belong to.
        </x-info-box>
    @endrole

    <x-form wire:submit.prevent="updateProfile">
        <div
        class="flex flex-col items-center gap-y-2 pb-5 border-b-2 border-gray-300
        lg:flex-row lg:items-start">
            {{-- Profile image --}}
            <div class="flex-1 w-40 space-y-2">
                {{-- Preview image --}}
                @if ($image && ($image->getClientOriginalExtension() === 'jpg' || $image->getClientOriginalExtension() === 'png' || $image->getClientOriginalExtension() === 'jpeg'))
                    <div class="w-40 h-40 mx-auto rounded-full overflow-hidden object-cover">
                        <img
                            class="w-full"
                            src="{{ $image->temporaryUrl() }}"
                            alt="profile_picture" />
                    </div>
                @else
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
                @endif

                {{-- File input --}}
                <label for="image" class="flex flex-col gap-y-2 items-center text-center text-sm">
                    {{-- Spinner --}}
                    <x-spinner wire:loading.flex wire:target="image">Updating...</x-spinner>

                    <input type="file" wire:model="image" id="image" class="hidden" accept="image/*">
                    <span class="border bg-gray-100 rounded px-2 py-1 text-gray-400 cursor-pointer hover:bg-gray-200">Update profile picture</span>
                    @error('image')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </label>
            </div>

            {{-- Profile details --}}
            <div class="flex-1 space-y-2 text-sm">
                <p class="font-bold text-base">{{ $user->fullname }}</p>
                <p class="text-gray-400">{{ $user->email }}</p>
                @role('student')
                    <p class="text-gray-400">{{ $user->userSpecialization->specialization->school->name }} | {{ $user->userSpecialization->specialization->name }}</p>
                    {{-- Check if user has a group --}}
                    @if (!is_null($user->userSpecialization->group_id))
                        <p class="text-gray-400">Group: {{ $user->userSpecialization->group->name }}</p>
                    @else
                        <p class="text-gray-400">Group: None</p>
                    @endif
                @endrole
                @if ($user->getRoleNames()->first() === 'student')
                    <span class="bg-indigo-100 text-indigo-400 rounded-lg inline-block px-2 py-1 text-sm">{{ $user->getRoleNames()->first() }}</span>
                @elseif ($user->getRoleNames()->first() === 'panelist')
                    <span class="bg-yellow-100 text-yellow-400 rounded-lg inline-block px-2 py-1 text-sm">{{ $user->getRoleNames()->first() }}</span>
                @else
                    <span class="bg-red-100 text-red-400 rounded-lg inline-block px-2 py-1 text-sm">{{ $user->getRoleNames()->first() }}</span>
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

        <div class="text-right">
            <x-app.button type="submit" color="green">Save Changes</x-app.button>
        </div>
    </x-form>
</div>
