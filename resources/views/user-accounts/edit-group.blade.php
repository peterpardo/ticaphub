<x-app-layout :scripts="$scripts">
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>

    <a href="/users/groups" class="bg-red-500 hover:bg-red-600 rounded text-white px-2 py-1">Back</a>

    <h1 class="font-semibold text-3xl text-center my-3">Edit Group</h1>

    <form action="/users/groups/{{ $group->id }}/edit" method="POST" class="w-96 mx-auto bg-white rounded shadow px-4 py-2">
        @csrf

        {{-- Alert Message --}}
        @if(session('status'))
            <div class="text-white w-full bg-{{ session('status') }}-500 rounded px-2 py-1 text-center">{{ session('message') }}</div>
        @endif

        {{-- Group name --}}
        <div class="my-3">
            <label class="block font-semibold text-lg mb-2 text-gray-800">Group name</label>
            <input type="text" name="group" value="{{ $group->name }}" class="rounded w-full text-gray-800 dark:text-gray-900">

            @error('group')
                <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        {{-- School --}}
        <div class="my-3">
            <label class="block font-semibold text-lg mb-2 text-gray-800">School</label>
            <select name="school" id="school" class="rounded w-full text-gray-800 dark:text-gray-900">
                @foreach ($schools as $school)
                    <option
                        value="{{ $school->id }}"
                        @if($group->specialization->school->id == $school->id) selected @endif>
                            {{ $school->name }}
                    </option>
                @endforeach
            </select>

            @error('school')
                <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        {{-- Specialization --}}
        <div class="my-3">
            <label class="block font-semibold text-lg mb-2 text-gray-800">Specialization</label>
            <select name="specialization" id="specialization" class="rounded w-full text-gray-800 dark:text-gray-900">
                <option value="" disable hidden>--select specialization--</option>
                @foreach ($specializations as $specialization)
                    <option
                        value="{{ $specialization->id }}"
                        @if($group->specialization->id == $specialization->id) selected @endif>
                            {{ $specialization->name }}
                    </option>
                @endforeach
            </select>

            @error('specialization')
                <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="px-4 py-1 bg-green-500 hover:bg-green-600 text-white rounded-md">Save</button>
        </div>

        @if($group->userGroups->count() == 0)
            <div class="bg-gray-100 rounded text-center py-5">No members</div>
        @else
            <p class="block font-semibold text-lg text-gray-800">Members</p>
            <ul>
                @foreach($group->userGroups as $userGroup)
                    <li class="px-2 py-4 text-lg text-center">{{ $userGroup->user->first_name }} {{ $userGroup->user->middle_name }} {{ $userGroup->user->last_name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
