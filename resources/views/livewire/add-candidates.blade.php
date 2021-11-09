<div>
    <div class="flex justify-between">
        <div class="font-semibold text-2xl dark:text-gray-50">Nominate Students</div>
        @if($users->count() > 0)
            <button wire:click="confirmCandidates" class="inline-block bg-green-600 py-2 px-10 rounded mr-10 text-white hover:bg-green-500">Start Election</button>
        @endif
    </div>
    {{-- STUDENT TABLE --}}
    @if($users->count() == 0)
        <div class="bg-gray-100 rounded text-center py-5 my-3">No Students in the system</div>
    @else
        {{-- SEARCH FOR CANDIDATES --}}
        <div class="mb-2 text-gray-800">
            <div class="flex justify-between">
                <div class="flex-1">
                    <h1 class="font-semibold dark:text-gray-50">Select Position</h1>
                    <select wire:model="selectedPosition" class="rounded ">
                        <option value="">--select position--</option>
                        @foreach($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" class="rounded my-2" placeholder="Search student name" autocomplete="off" wire:model.debounce.350ms="search">
                </div>
                <div class="my-2 flex-1">
                    <h1 class="font-semibold dark:text-gray-50">Filters</h1>
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
            @error('selectedPosition')
            <span class="bg-red-500 rounded shadow text-white py-1 px-2">{{ $message }}</span>
            @enderror
            @if(session('status'))
            <span class="bg-{{ session('status') }}-500 rounded shadow text-white py-1 px-2">{{ session('message') }}</span>
            @endif
        </div>
        {{-- SEARCH FOR CANDIDATES --}}

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
                @foreach($users as $user)
                <tr class="text-gray-700">
                    <td class="px-4 py-1 border">
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
                        <button wire:click="addCandidate({{ $user->id }})" class="w-1/2 rounded shadow px-2 py-1 text-white bg-blue-500 hover:bg-blue-600">Add</button>
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
    @endif
    {{-- STUDENT TABLE --}}

    {{-- CANDIDATES TABLE --}}
    <div class="font-semibold text-2xl my-3">Candidates</div>

    @if($candidates->count() == 0)
        <div class="bg-gray-100 rounded py-6 text-center mx-auto dark:text-gray-800">No candidates found</div>
    @else
        <div class="mb-3 text-gray-800">
            <label class="block font-semibold dark:text-gray-50">Filter</label>
            <select wire:model="selectedElection" class="rounded">
                <option value="">-- select election --</option>
                @foreach ($elections as $election)
                <option value="{{ $election->id }}">{{ $election->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full">
            <table class="w-full table-fixed">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Student Name</th>
                    <th class="px-4 py-3">Election</th>
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
                            @if($candidate->user->profile_picture)
                                <img class="object-cover w-full h-full rounded-full" src="{{ Storage::url($candidate->user->profile_picture) }}" alt="" loading="lazy" />
                            @else
                                <img class="object-cover w-full h-full rounded-full" src="{{ url(asset('assets/default-img.png')) }}" alt="" loading="lazy" />
                            @endif
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                            </div>
                            <div>
                                <p class="font-semibold text-black text-md text-center">
                                    {{ $candidate->user->first_name }} {{ $candidate->user->middle_name }} {{ $candidate->user->last_name }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-md font-semibold border">{{ $candidate->election->name }}</td>
                    <td class="px-4 py-3 text-md font-semibold border">{{ $candidate->position->name }}</td>
                    <td class="px-4 py-3 text-md border text-center">
                        <button wire:click="deleteCandidate({{ $candidate->id }})" class="rounded shadow px-2 py-1 text-white bg-red-500 hover:bg-red-600">delete</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    @endif
    {{-- CANDIDATES TABLE --}}

     {{-- CONFIRMATION MODAL --}}
     <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="confirmationModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div class="text-gray-800">
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8 mb-5">Do you want to start the Election with these settings? You will not be able to change it once you proceed.</p>
                    <h1 class="font-bold text-center mb-2">Election Lists</h1>
                    <table class="w-full border-collapse border border-black">
                        <thead>
                            <tr>
                                <th class="border-black border">Election</th>
                                <th class="border-black border">No. of Candidates</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($elections as $election)
                            <tr>
                                <td class="border-black border">
                                    {{ $election->name }}
                                </td>
                                <td class="border-black border">
                                    {{ $election->candidates->count() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeConfirmationModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="startElection" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    {{-- CONFIRMATION MODAL --}}
</div>
