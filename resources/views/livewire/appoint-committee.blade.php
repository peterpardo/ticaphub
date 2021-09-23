<div>
    <h1 class="text-center font-semibold text-3xl">Appoint Committee Head</h1>
    <div>
        <div class="flex my-2">
            <div class="mx-2">
                <label class="block font-semibold text-lg">Committee Name</label>
                <input type="text" wire:model.defer="name" class="rounded">
            </div>
            <div class="mx-2">
                <label class="block font-semibold text-lg">Committe Head</label>
                <input type="text" wire:model.debounce.350ms="search" class="rounded" placeholder="Search student">
            </div>
        </div>
        @error('name')
        <div class="bg-red-500 text-white px-2 py-1 rounded w-52 mt-1">{{ $message }}</div>
        @enderror  
        @if(session('status'))
        <div class="bg-{{ session('status') }}-500 text-white px-2 py-1 rounded w-96 mt-1">{{ session('message') }}</div>
        @endif
    </div>
    {{-- STUDENT TABLE --}}
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3">Student Name</th>
                <th class="px-4 py-3">School</th>
                <th class="px-4 py-3">Specialization</th>
                <th class="px-4 py-3">Action</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            @foreach($users as $user)
            @if($user->hasExactRoles('student'))
            <tr class="text-gray-700">
                <td class="px-4 py-3 border">
                <div class="flex items-center text-sm">
                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                    <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                    <div>
                    <p class="font-semibold text-black text-lg">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</p>
                    </div>
                </div>
                </td>
                <td class="px-4 py-3 text-md font-semibold border">{{ $user->school->name }}</td>
                <td class="px-4 py-3 text-md border">{{ $user->userSpecialization->specialization->name }}</td>
                <td class="px-4 py-3 text-md border text-center">
                    <button wire:click="appoint({{ $user->id }})" class="rounded shadow px-2 py-2 text-white bg-blue-500 hover:bg-blue-600">Appoint</button>
                </td>
            </tr>
            @endif
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="my-2 mx-1">
            {{ $users->links() }}
        </div>
    </div>
    {{-- STUDENT TABLE --}}

    {{-- COMMITTEE TABLE --}}
    <h1 class="text-center font-semibold text-3xl">Committees</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3">Committee Name</th>
                <th class="px-4 py-3">Committee Head</th>
                <th class="px-4 py-3">School</th>
                <th class="px-4 py-3">Specialization</th>
                <th class="px-4 py-3">Action</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            @foreach($committees as $committee)
            <tr class="text-gray-700">
                <td class="px-4 py-3 border">{{ $committee->name }}</td>
                <td class="px-4 py-3 border">{{ $committee->user->first_name }} {{ $committee->user->middle_name }} {{ $committee->user->last_name }}</td>
                <td class="px-4 py-3 text-md font-semibold border">{{ $committee->user->school->name }}</td>
                <td class="px-4 py-3 text-md border">{{ $committee->user->userSpecialization->specialization->name }}</td>
                <td class="px-4 py-3 text-md border text-center">
                    <button wire:click="deleteCommittee({{ $committee->user->id }})" class="rounded shadow px-2 py-2 text-white bg-red-500 hover:bg-red-600">Delete</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    {{-- COMMITTEE TABLE --}}
</div>
