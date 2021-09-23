<div>
    <div class="w-full">
        <form 
            action="/users/{{ $user->id }}/edit-user"
            method="POST"
            class="w-96 mx-auto bg-white rounded shadow px-4 py-2">
            @csrf
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Student Number</label>
                <input type="text" name="student_number" class="rounded w-full bg-gray-300" value="{{ $user->student_number }}">
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">First Name</label>
                <input type="text" name="first_name" class="rounded w-full" value="{{ $user->first_name }}">
                @error('first_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Middle Name</label>
                <input type="text" name="middle_name" class="rounded w-full" value="{{ $user->middle_name }}">
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Last Name</label>
                <input type="text" name="last_name" class="rounded w-full" value="{{ $user->last_name }}">
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Email</label>
                <input type="email" name="email" class="rounded w-full bg-gray-300" value="{{ $user->email }}" disabled>
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">School</label>
                <input type="text" class="rounded w-full bg-gray-300" value="{{ $user->school->name }}" disabled>
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Specialization</label>
                <input type="text" class="rounded w-full bg-gray-300" value="{{ $user->userSpecialization->specialization->name }}" disabled>
            </div>
            <div class="my-3">
                <label class="block font-semibold text-lg mb-2">Group</label>
                <select name="group" class="rounded w-full" wire:model="group">
                    <option value="{{ $user->userGroup->group->id }}">{{ $user->userGroup->group->name }}</option>
                    @foreach($groups as $group)
                    @if($group->id != $user->userGroup->group->id && $group->specialization->id == $user->userSpecialization->specialization->id && $group->school->id == $user->school->id)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="rounded bg-green-500 hover:bg-green-600 text-white px-2 py-1 w-full mb-2">Submit</button>
        </form>
    </div>
</div>
