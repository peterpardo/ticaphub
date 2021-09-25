<div>
    {{-- SEARCH FOR CANDIDATES --}}
    <div class="mb-2">
        <div class="flex justify-between">
            <div class="font-semibold text-2xl">Add Candidates</div>
            <a href="{{ route('election') }}" class="inline-block bg-green-600 py-2 px-10 rounded mr-10 text-white hover:bg-green-500">Start Election</a>
        </div>
        <div class="my-2">
            <select wire:model="bySchool" class="rounded ">
                <option value="">--select school--</option>
                @foreach($schools as $school)
                @if($school->is_involved)
                <option value="{{ $school->id }}">{{ $school->name }}</option>
                @endif
                @endforeach
            </select>
            <select wire:model="bySpecialization" class="rounded ">
                <option value="">--select specialization--</option>
                @foreach($specializations as $specialization)
                <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                @endforeach
            </select>
            <select wire:model="byPosition" class="rounded ">
                <option value="">--select position--</option>
                @foreach($positions as $position)
                <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
        </div>
        @error('byPosition')
        <div class="bg-red-500 rounded shadow w-56 text-white py-1 px-2">{{ $message }}</div>
        @enderror
        <input type="text" class="rounded my-2" placeholder="Search student name" autocomplete="off" wire:model.debounce.350ms="search">
        @if(session('status'))
            <div class="bg-{{ session('status') }}-500 rounded shadow text-white py-1 px-2">{{ session('message') }}</div>
        @endif
    </div>
    {{-- SEARCH FOR CANDIDATES --}}

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
            @if($user->hasRole('student'))
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
                    <button wire:click="addCandidate({{ $user->id }})" class="w-1/2 rounded shadow px-2 py-2 text-white bg-blue-500 hover:bg-blue-600">Add</button>
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

    {{-- CANDIDATES TABLE --}}
    <h1 class="text-center font-bold text-2xl">Candidates</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3">Student Name</th>
                <th class="px-4 py-3">School</th>
                <th class="px-4 py-3">Specialization</th>
                <th class="px-4 py-3">Position</th>
                <th class="px-4 py-3">Action</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            @foreach($candidates as $candidate)
            <tr class="text-gray-700">
                <td class="px-4 py-3 border">
                <div class="flex items-center text-sm">
                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                    <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                    <div>
                    <p class="font-semibold text-black text-lg">{{ $candidate->user->first_name }} {{ $candidate->user->middle_name }} {{ $candidate->user->last_name }}</p>
                    </div>
                </div>
                </td>
                <td class="px-4 py-3 text-md font-semibold border">{{ $candidate->school->name }}</td>
                <td class="px-4 py-3 text-md border">{{ $candidate->specialization->name }}</td>
                <td class="px-4 py-3 text-md border">{{ $candidate->position->name }}</td>
                <td class="px-4 py-3 text-md border text-center">
                    <button wire:click="deleteCandidate({{ $candidate->user->id }})" class="rounded shadow px-2 py-2 text-white bg-red-500 hover:bg-red-600">Delete</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="my-2 mx-1">
            {{ $candidates->links() }}
        </div>
    </div>
    {{-- CANDIDATES TABLE --}}
</div>
