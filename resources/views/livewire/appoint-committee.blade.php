<div>
    <h1 class="text-center font-semibold text-3xl">Appoint Committee Head</h1>
    <div>
        <div class="mb-2">
            <label class="block font-semibold text-lg">Committee Name</label>
            <div class="flex justify-between flex-wrap text-gray-800">
                <input type="text" wire:model.defer="name" class="rounded mb-2">
                <input type="text" wire:model.debounce.350ms="search" class="rounded mb-2" placeholder="Search student">
            </div>
        </div>
        @error('name')
        <span class="bg-red-500 text-white px-2 py-1 rounded w-52">{{ $message }}</span>
        @enderror
        @if(session('status'))
        <span class="bg-{{ session('status') }}-500 text-white px-2 py-1 rounded w-auto">{{ session('message') }}</span>
        @endif
    </div>
    {{-- STUDENT TABLE --}}
    <div class="mt-5 bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
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
                </div>
                </td>
                <td class="px-4 py-3 text-md font-semibold border">{{ $user->userSpecialization->specialization->school->name }}</td>
                <td class="px-4 py-3 text-md border">{{ $user->userSpecialization->specialization->name }}</td>
                <td class="px-4 py-3 text-md border text-center">
                    <button wire:click="appoint({{ $user->id }})" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 rounded shadow px-2 py-2 text-white bg-blue-500 hover:bg-blue-600">Appoint</button>
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

    {{-- COMMITTEE TABLE --}}
    <h1 class="text-center font-semibold text-3xl">Committees</h1>
    @if($committees->count() == 0)
        <div class="bg-transparent text-center font-extralight my-2 rounded py-5">No Committees</div>
    @else
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full">
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
                    <td class="px-4 py-3 border">
                        <div class="flex items-center text-sm">
                            <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                            @if($committee->user->profile_picture)
                                <img class="object-cover w-full h-full rounded-full" src="{{ Storage::url($committee->user->profile_picture) }}" alt="" loading="lazy" />
                            @else
                                <img class="object-cover w-full h-full rounded-full" src="{{ url(asset('assets/default-img.png')) }}" alt="" loading="lazy" />
                            @endif
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                            </div>
                            <div>
                                <p class="font-semibold text-black text-md text-center">
                                    {{ $committee->user->first_name }} {{ $committee->user->middle_name }} {{ $committee->user->last_name }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-md font-semibold border">{{ $committee->user->userSpecialization->specialization->school->name }}</td>
                    <td class="px-4 py-3 text-md border">{{ $committee->user->userSpecialization->specialization->name }}</td>
                    <td class="px-4 py-3 text-md border text-center">
                        <button wire:click="selectCommittee({{ $committee->id }}, 'update')" class="rounded shadow px-2 py-2 text-white bg-blue-500 hover:bg-blue-600">Edit</button>
                        <button wire:click="selectCommittee({{ $committee->id }}, 'delete')" class="rounded shadow px-2 py-2 text-white bg-red-500 hover:bg-red-600">Delete</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    @endif
    {{-- COMMITTEE TABLE --}}

    {{-- DELETE COMMITTEE MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="deleteCommitteeModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-bold py-4 text-gray-800">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8">Do you really want to delete the committee? This process cannot be undone.</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeDeleteModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="deleteCommittee" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE COMMITTEE MODAL --}}

    {{-- UPDATE COMMITTEE MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="updateCommitteeModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                @livewire('committee-form')
            </div>
        </div>
    </div>
    {{-- UPDATE COMMITTEE MODAL --}}
</div>
