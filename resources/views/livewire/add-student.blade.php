<div>
    <h1 class="font-bold text-center text-3xl my-4">Add Student</h1>
    {{-- ADD STUDENT FORM --}}
    <div class="w-full text-gray-800">
        <div class="text-center">
            <a href="/users/invite-users" class="rounded bg-blue-500 hover:bg-blue-600 py-1 px-2 text-white">Import Students</a>
        </div>
        <form 
            action="/users/add-student"
            method="POST"
            class="w-96 mx-auto bg-white rounded shadow px-4 py-2">
            @csrf
            @if(session('status'))
            <div class="text-white w-full rounded py-1 px-2 bg-green-500">{{ session('message') }}</div>
            @endif
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">ID Number</label>
                <input type="text" name="id_number" class="rounded w-full text-black dark:text-gray-900" value="{{ old('id_number') }}" autocomplete="off" placeholder="Ex: 201811780">
                @error('id_number')
                <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">First Name</label>
                <input type="text" name="first_name" class="rounded w-full text-black dark:text-gray-900" value="{{ old('first_name') }}" autocomplete="off">
                @error('first_name')
                <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Middle Name</label>
                <input type="text" name="middle_name" class="rounded w-full text-black dark:text-gray-900" value="{{ old('middle_name') }}" autocomplete="off">
                @error('middle_name')
                  <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Last Name</label>
                <input type="text" name="last_name" class="rounded w-full text-black dark:text-gray-900" value="{{ old('last_name') }}" autocomplete="off">
                @error('last_name')
                  <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Email</label>
                <input type="email" name="email" class="rounded w-full text-black dark:text-gray-900" value="{{ old('email') }}" autocomplete="off">
                @error('email')
                  <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">School</label>
                <select name="school" class="w-full rounded font-semibold text-base text-gray-900 dark:text-gray-900" wire:model="selectedSchool">
                    <option value="">--select school--</option>
                    @foreach ($schools as $school)
                    @if($school->is_involved)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endif
                    @endforeach
                </select>
                @error('school')
                  <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>
            @if(!is_null($selectedSchool))
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Specialization</label>
                <select name="specialization" class="w-full rounded" wire:model="selectedSpec">
                    <option value="">--select specialization--</option>
                    @foreach ($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                    @endforeach
                </select>
                @error('specialization')
                  <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>
            @endif  
            @if(!is_null($selectedSpec))
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Group</label>
                <input type="text" name="group" wire:model="selectedGroup" class="rounded w-full text-black dark:text-gray-900" value="{{ old('group') }}" autocomplete="off" placeholder="Enter group name">
                @if($groups != null)
                <ul class="my-2">
                    <p class="font-semibold">Existing Groups</p>
                    @foreach ($groups as $group)
                    <li class="my-2">
                        {{ $group->name }}
                        <button wire:click.prevent="insertGroup('{{ $group->name }}')" class="text-white rounded bg-green-500 hover:bg-green-600 px-2 py-1">Select</button>
                    </li>
                    @endforeach
                </ul>
                @endif
                @error('group')
                  <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                @enderror
            </div>
            @endif
            <div class="flex justify-evenly my-3 text-gray-800">
                <a href="{{ route('users') }}" class="inline-block rounded shadow-lg px-4 py-2 hover:bg-gray-100">Cancel</a>
                <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Add</button>
            </div>
        </form>
    </div>
    {{-- ADD STUDENT FORM --}}
</div>

   

    

