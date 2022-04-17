<div>
    <h1 class="font-bold text-center text-3xl my-4">Edit User</h1>
    <div class="w-full">
        <form class="w-96 mx-auto bg-white rounded shadow px-4 py-2" wire:submit.prevent='updateUser'>
            @csrf

            {{-- First name --}}
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2 text-gray-800">First Name</label>
                <input type="text" wire:model="first_name" class="rounded w-full text-gray-800 dark:text-gray-900">

                @error('first_name')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Middle name --}}
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2 text-gray-800">Middle Name</label>
                <input type="text" wire:model="middle_name" class="rounded w-full text-gray-800 dark:text-gray-900">

                @error('middle_name')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Last name --}}
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2 text-gray-800">Last Name</label>
                <input type="text" wire:model="last_name" class="rounded w-full text-gray-800 dark:text-gray-900">

                @error('last_name')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2 text-gray-800">Email</label>
                <input type="email" wire:model="email" class="rounded w-full text-gray-800 dark:text-gray-900">

                @error('email')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Show other input fields if user is a student --}}
            @if($user->hasRole('student'))
                {{-- Student number --}}
                <div class="my-3">
                    <label class="block font-semibold text-lg mb-2 text-gray-800">Student Number</label>
                    <input type="text" wire:model="id_number" class="rounded w-full text-gray-800 dark:text-gray-900">

                    @error('id_number')
                        <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                    @enderror
                </div>

                {{-- School --}}
                <div class="my-3">
                    <label class="block font-semibold text-lg mb-2 text-gray-800">School</label>
                    <select wire:model="selectedSchool" class="w-full rounded">
                        <option value="">--select school--</option>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>

                    @error('selectedSchool')
                        <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Specialization --}}
                <div class="my-3">
                    <label class="block font-semibold text-lg mb-2 text-gray-800">Specialization</label>
                    <select wire:model="selectedSpec" class="w-full rounded">
                        <option value="">--select specialization--</option>
                        @foreach ($specs as $spec)
                            <option value="{{ $spec->id }}">{{ $spec->name }}</option>
                        @endforeach
                    </select>

                    @error('selectedSpec')
                        <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Group --}}
                <div class="my-3">
                    <label class="block font-semibold text-lg mb-2 text-gray-800">Group</label>
                    <select class="rounded w-full text-gray-800 dark:text-gray-900" wire:model="selectedGroup">
                        <option value="">--select group--</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>

                    @error('selectedGroup')
                        <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <div class="flex justify-evenly my-3">
                <a href="/users" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 inline-block text-gray-800 rounded shadow-lg px-4 py-2 hover:bg-gray-100">Cancel</a>
                <button type="submit" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Update</button>
            </div>
        </form>
    </div>
</div>
