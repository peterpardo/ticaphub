<div>
    @if(session('status'))
        <div class="text-center bg-red-500 text-white rounded py-5 my-3">{{ session('message') }}</div>
    @endif
    <div class="text-right my-4">
        <button wire:click="confirmElection" class="bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500">Get Election Results</button>
    </div>
    <div class="flex flex-wrap justify-evenly w-full">
        @foreach($elections as $election)
            @if($election->officers()->where('is_elected', 0)->exists())
            <div class="w-2/5">
                <h1 class="text-2xl font-semibold">{{ $election->name }}</h1>
                <div class="mb-3">
                    <p>{{ \App\Models\UserElection::all()->where('election_id', $election->id)->where('has_voted', 1)->count() }} out of   {{ \App\Models\UserElection::all()->where('election_id', $election->id)->count() }} has voted</p>
                </div>
                <table class="w-full rounded-t-lg shadow-lg mx-1 text-center my-3 overflow-hidden">
                    <thead>
                        <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-gray-100 uppercase border-gray-600">  <tr class="bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Position</th>
                            <th class="px-4 py-3">Officer</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($positions as $position)
                        <tr>
                            <td class="border py-2">{{ $position->name }}</td>
                            <td class="border py-2">
                                <ul>
                                @foreach($election->officers->where('position_id', $position->id) as $officer)
                                    <li class="py-3">
                                        <div class="flex justify-center items-center text-sm">
                                            <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                            @if($officer->user->profile_picture)
                                                <img class="object-cover w-full h-full rounded-full" src="{{ Storage::url($officer->user->profile_picture) }}" alt="" loading="lazy" />
                                            @else
                                                <img class="object-cover w-full h-full rounded-full" src="{{ url(asset('assets/default-img.png')) }}" alt="" loading="lazy" />
                                            @endif
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-black text-md text-center">
                                                    {{ $officer->user->first_name }} {{ $officer->user->middle_name }} {{ $officer->user->last_name }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            </td>
                            <td class="border">
                                <ul>
                                @foreach($election->officers->where('position_id', $position->id) as $officer)
                                    @if($officer->is_elected)
                                    <li class="text-green-500 py-4">elected</li>
                                    @else
                                    <li class="py-4">{{ \App\Models\Vote::where('candidate_id', $officer->user->candidate->id)->count() }}</li>
                                    @endif
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
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
                                @if($election->officers()->where('is_elected', 0)->exists())
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
                                @endif
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
</div>
