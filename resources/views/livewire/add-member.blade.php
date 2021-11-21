<div>
    <div class="mb-2">
        <a href="/committee/{{ $committee->id }}" class="inline-block bg-red-500 hover:bg-red-600 px-2 py-1 text-white rounded">Back</a>
        <div class="font-semibold text-3xl text-center">Add Members</div>
        @if(session('status'))
        <div class="text-center bg-{{ session('status') }}-100 border-l-4 border-{{ session('status') }}-500 text-{{ session('status') }}-700 p-4" role="alert">
            <p class="font-bold">{{ session('message') }}</p>
          </div>
        @endif
        <div class="flex justify-between my-3 text-gray-800">
            <div class="flex-1">
                <input type="text" class="rounded" placeholder="Search student name" autocomplete="off" wire:model.debounce.350ms="search">
            </div>
            <div class="flex-1">
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
        </div>
    </div>
    {{-- SEARCH FOR CANDIDATES --}}

      {{-- STUDENT TABLE --}}
      <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3">Student Name</th>
                <th class="px-4 py-3">School</th>
                <th class="px-4 py-3">Specialization</th>
                <th class="px-4 py-3">Action</th>
            </tr>
            </thead>
        <tbody class="bg-white">
            @foreach($users as $user)
            <tr class="text-gray-700">
                <td class="px-4 py-3 border">
                    <div class="flex items-center text-sm">
                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                        @if($user->profile_picture)
                            <img class="object-cover w-full h-full rounded-full" src="{{ Storage::url($user->profile_picture) }}" alt="" loading="lazy" />
                        @else
                            <img class="object-cover w-full h-full rounded-full" src="{{ url(asset('assets/default-img.png')) }}" alt="" loading="lazy" />
                        @endif
                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                            <p class="font-semibold text-black text-md text-center">
                                {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
                            </p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 text-md font-semibold border">{{ $user->userSpecialization->specialization->school->name }}</td>
                <td class="px-4 py-3 text-md border">{{ $user->userSpecialization->specialization->name }}</td>
                <td class="px-4 py-3 text-md border text-center">
                    <button wire:click="addMember({{ $user->id }})" class="rounded shadow px-2 py-1 text-white bg-blue-500 hover:bg-blue-600">Add</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="my-2 mx-1 bg-white rounded">
            {{ $users->links() }}
        </div>
    </div>
    {{-- STUDENT TABLE --}}

    {{-- MEMBER TABLE --}}
    <div class="font-semibold text-2xl">Committee Members</div>
    @if($members->count() == 0)
    <div class="text-center bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">No Members Found</p>
      </div>
    @else
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full">
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
                    <td class="px-4 py-3 border">
                    <div class="flex items-center text-sm">
                        <div class="flex items-center text-sm">
                            <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                            @if($member->user->profile_picture)
                                <img class="object-cover w-full h-full rounded-full" src="{{ Storage::url($member->user->profile_picture) }}" alt="" loading="lazy" />
                            @else
                                <img class="object-cover w-full h-full rounded-full" src="{{ url(asset('assets/default-img.png')) }}" alt="" loading="lazy" />
                            @endif
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                            </div>
                            <div>
                                <p class="font-semibold text-black text-md text-center">
                                    {{ $member->user->first_name }} {{ $member->user->middle_name }} {{ $member->user->last_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    </td>
                    <td class="px-4 py-3 text-md font-semibold border">{{ $member->user->userSpecialization->specialization->school->name }}</td>
                    <td class="px-4 py-3 text-md border">{{ $member->user->userSpecialization->specialization->name }}</td>
                    <td class="px-4 py-3 text-md border text-center">
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
