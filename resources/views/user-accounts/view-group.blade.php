<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>

    <a href="/users/groups" class="bg-red-500 hover:bg-red-600 rounded text-white px-2 py-1">Back</a>

    <h1 class="font-semibold text-3xl text-center my-3">View Group</h1>

    <div class="w-96 mx-auto bg-white rounded shadow px-4 py-2">
        {{-- Group name --}}
        <div class="my-3">
            <label class="block font-semibold text-lg mb-2 text-gray-800">Group Name</label>
            <input type="text" value="{{ $group->name }}" class="rounded w-full text-gray-800 dark:text-gray-900" disabled>
        </div>

        {{-- School --}}
        <div class="my-3">
            <label class="block font-semibold text-lg mb-2 text-gray-800">School</label>
            <input type="text" value="{{ $group->specialization->name }}" class="rounded w-full text-gray-800 dark:text-gray-900" disabled>
        </div>

        {{-- Specialization --}}
        <div class="my-3">
            <label class="block font-semibold text-lg mb-2 text-gray-800">Specialization</label>
            <input type="text" value="{{ $group->specialization->school->name }}" class="rounded w-full text-gray-800 dark:text-gray-900" disabled>
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
