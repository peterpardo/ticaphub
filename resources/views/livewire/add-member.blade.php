<div>
    <div class="mb-2">
        <a href="/committee/{{ $committee->id }}" class="inline-block bg-red-500 hover:bg-red-600 px-2 py-1 text-white rounded">Back</a>
        <div class="font-semibold text-2xl">Add Members</div>
        <div class="flex flex-col">
            <div>
                <h1 class="font-semibold">Filters</h1>
                <select wire:model="selectedSchool" class="rounded ">
                    <option value="">--select school--</option>
                    @foreach($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
                @if($selectedSchool != null)
                <select wire:model="selectedSpec" class="rounded ">
                    <option value="">--select specialization--</option>
                    @foreach($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                    @endforeach
                </select>
                @endif
            </div>
            <div>
                <input type="text" class="rounded my-2" placeholder="Search student name" autocomplete="off" wire:model.debounce.350ms="search">
            </div>
        </div>
        @if(session('status'))
        <span class="bg-{{ session('status') }}-500 rounded shadow text-white py-1 px-2">{{ session('message') }}</span>
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
            <tr class="text-gray-700">
                <td class="px-4 py-1 border">
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
                <td class="px-4 py-2 text-md font-semibold border">{{ $user->userSpecialization->specialization->school->name }}</td>
                <td class="px-4 py-2 text-md border">{{ $user->userSpecialization->specialization->name }}</td>
                <td class="px-4 py-2 text-md border text-center">
                    <button wire:click="addMember({{ $user->id }})" class="rounded shadow px-2 py-1 text-white bg-blue-500 hover:bg-blue-600">Add</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="my-2 mx-1">
            {{ $users->links() }}
        </div>
    </div>
    {{-- STUDENT TABLE --}}

    {{-- MEMBER TABLE --}}
    <div class="font-semibold text-2xl">Committee Members</div>
    @if($members->count() == 0)
        <div class="bg-gray-200 rounded py-5 block text-center">No Members</div>
    @else
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
                @foreach($members as $member)
                <tr class="text-gray-700">
                    <td class="px-4 py-1 border">
                    <div class="flex items-center text-sm">
                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                        <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                        <p class="font-semibold text-black text-lg">{{ $member->user->first_name }} {{ $member->user->middle_name }} {{ $member->user->last_name }}</p>
                        </div>
                    </div>
                    </td>
                    <td class="px-4 py-2 text-md font-semibold border">{{ $member->user->userSpecialization->specialization->school->name }}</td>
                    <td class="px-4 py-2 text-md border">{{ $member->user->userSpecialization->specialization->name }}</td>
                    <td class="px-4 py-2 text-md border text-center">
                        <button wire:click="deleteMember({{ $member->user->id }})" class="rounded shadow px-2 py-1 text-white bg-red-500 hover:bg-red-600">Delete</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    @endif
    {{-- MEMBER TABLE --}}
</div>
