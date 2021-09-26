<div>
    <div class="w-full">
        <form class="w-96 mx-auto bg-white rounded shadow px-4 py-2" wire:submit.prevent='updateUser'>
            @csrf
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">First Name</label>
                <input type="text" wire:model="first_name" class="rounded w-full">
                @error('first_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Middle Name</label>
                <input type="text" wire:model="middle_name" class="rounded w-full">
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Last Name</label>
                <input type="text" wire:model="last_name" class="rounded w-full">
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Email</label>
                <input type="email" wire:model="email" class="rounded w-full">
            </div>
            @if($user->hasRole('student'))
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">ID Number</label>
                <input type="text" wire:model="id_number" class="rounded w-full">
                @error('id_number')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">School</label>
                <select wire:model="selectedSchool" class="w-full rounded">
                    @foreach ($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Specialization</label>
                <select wire:model="selectedSpec" class="w-full rounded">
                    @foreach ($specs as $spec)
                    <option value="{{ $spec->id }}">{{ $spec->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Group</label>
                <select class="rounded w-full" wire:model="selectedGroup">
                    @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="flex justify-evenly my-3">
                <a href="/users" class="inline-block rounded shadow-lg px-4 py-2 hover:bg-gray-100">Cancel</a>
                <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Update</button>
            </div>
        </form>
    </div>
</div>
