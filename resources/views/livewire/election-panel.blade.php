<div>
    @if(session('status'))
    <div class="text-center bg-{{ session('status') }}-100 border-l-4 border-{{ session('status') }}-500 text-{{ session('status') }}-700 p-4" role="alert">
        <p class="font-bold">{{ session('message') }}</p>
    </div>
    @endif
    <div class="flex justify-between my-3">
        <button wire:click="openUpdateModal" class="inline-block bg-blue-600 hover:bg-blue-500 rounded text-white px-5 py-2">Update Election</button>
        <button wire:click='endElection' class="bg-green-600 py-2 px-5 rounded text-white hover:bg-green-500">Get Election Results</button>
    </div>
    <div class="flex flex-wrap justify-evenly w-full">
        @foreach($elections as $election)
        <div class="w-2/5 my-5">
            <h1 class="text-2xl font-semibold">{{ $election->name }}</h1>
            <div>
                <div class="mb-3">
                    <p>{{ \App\Models\UserElection::all()->where('election_id', $election->id)->where('has_voted', 1)->count() }} out of   {{ \App\Models\UserElection::all()->where('election_id', $election->id)->count() }} has voted</p>
                </div>
                <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                        <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Position</th>
                            <th class="px-4 py-3">Candidate</th>
                            <th class="px-4 py-3">Votes</th>
                        </tr>
                    </thead>
                    <tbody class="w-auto bg-white text-center">
                        @foreach($positions as $position)
                        <tr class="text-gray-800">
                            <td class="border">{{ $position->name }}</td>
                            <td class="border py-2">
                                @foreach($election->candidates as $candidate)
                                <ul>
                                    @if($candidate->position_id == $position->id)
                                    <li class="py-3">
                                        <div class="flex justify-center items-center text-sm">
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
                                    </li>
                                    @endif
                                </ul>
                                @endforeach
                            </td>
                            <td class="border py-2">
                                @foreach($election->candidates as $candidate)
                                <ul>
                                    @if($candidate->position_id == $position->id)
                                    <li class="py-4">{{ $candidate->votes->where('candidate_id', $candidate->id)->count() }}</li>
                                    @endif
                                </ul>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- CONFIRMATION MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="confirmationModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div class="text-gray-800">
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8 mb-3">Do you want to end the election? Students will not be able to vote anymore once you proceed</p>
                    <h1 class="font-bold text-center mb-2">Election Lists</h1>
                    <table class="w-full border-collapse border border-black">
                        <thead>
                            <tr>
                                <th class="border-black border">Election</th>
                                <th class="border-black border">No. of Students</th>
                                <th class="border-black border">Has voted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($elections as $election)
                            <tr>
                                <td class="border-black border">
                                    {{ $election->name }}
                                </td>
                                <td class="border-black border">
                                    {{ $election->userElections->count()}}
                                </td>
                                <td class="border-black border">
                                    {{ $election->userElections->where('has_voted', 1)->count() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeConfirmationModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="getElectionResults" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    {{-- CONFIRMATION MODAL --}}

    {{-- UPDATE ELECTION MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="updateElectionModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div class="text-gray-800">
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8 mb-3">Do you want to update the election? The votes will be reset once you proceed.</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeUpdateModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="updateElection" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    {{-- UPDATE ELECTION MODAL --}}
</div>
