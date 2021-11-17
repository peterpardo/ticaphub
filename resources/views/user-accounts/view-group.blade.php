<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>

    <a href="/users/groups" class="bg-red-500 hover:bg-red-600 rounded text-white px-2 py-1">Back</a>

    <div class="w-1/2 mx-auto mt-3 rounded shadow-md px-3 py-2">
        <h1 class="text-center text-2xl font-semibold my-1">{{ $group->name }}</h1>
        @if($group->userGroups->count() == 0) 
            <div class="bg-gray-100 rounded text-center py-5">No members</div>
        @else
            <p class="text-lg">Members:</p>
            <ul>
                @foreach($group->userGroups as $userGroup)
                    <li class="px-2 py-4 text-lg text-center">{{ $userGroup->user->first_name }} {{ $userGroup->user->middle_name }} {{ $userGroup->user->last_name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
