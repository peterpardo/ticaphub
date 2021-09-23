<div>
    <h1 class="font-bold text-center text-3xl my-4">Add Student</h1>
    {{-- ADD STUDENT FORM --}}
    <div class="w-full">
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
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">First Name</label>
                <input type="text" name="first_name" class="rounded w-full text-black dark:text-gray-900" value="{{ old('first_name') }}" autocomplete="off">
                @error('first_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Middle Name</label>
                <input type="text" name="middle_name" class="rounded w-full text-black dark:text-gray-900" value="{{ old('middle_name') }}" autocomplete="off">
                @error('middle_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Last Name</label>
                <input type="text" name="last_name" class="rounded w-full text-black dark:text-gray-900" value="{{ old('last_name') }}" autocomplete="off">
                @error('last_name')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Email</label>
                <input type="email" name="email" class="rounded w-full text-black dark:text-gray-900" value="{{ old('email') }}" autocomplete="off">
                @error('email')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
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
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            @if($selectedSchool != "" && !is_null($selectedSchool) )
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Specialization</label>
                <select name="specialization" class="w-full rounded" wire:model="selectedSpec">
                    <option value="">--select specialization--</option>
                    @foreach ($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                    @endforeach
                </select>
                @error('specialization')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            @endif
            @if($selectedSpec != "" && !is_null($selectedSpec))
            <div class="my-3">
                <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Group</label>
                <input type="text" name="group" class="rounded w-full text-black dark:text-gray-900" value="{{ old('group') }}" autocomplete="off">
                @error('group')
                <div class="bg-red-500 rounded w-full py-1 px-2 mt-1 text-white">{{ $message }}</div>
                @enderror
            </div>
            @endif
            <div class="text-center">
                <button type="submit" class="md:w-32 bg-green-600 dark:bg-green-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-green-500 dark:hover:bg-green-200 transition ease-in-out duration-300">Submit</button>
            </div>
        </form>
    </div>
    {{-- ADD STUDENT FORM --}}
</div>

   

    

