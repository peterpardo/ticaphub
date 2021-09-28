<div>
    <div class="flex flex-wrap justify-evenly w-full">
        @foreach($elections as $election)
            <div class="w-2/5">
                <h1 class="text-xl font-semibold">{{ $election->name }}</h1>
                <div>
                    <table class="w-full rounded-lg shadow-lg mx-1 text-center my-3">    
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">Position</th>
                                <th class="px-4 py-3">Officer</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-transparent dark:bg-gray-600">
                            @foreach($positions as $position)
                            <tr>
                                <td class="border">{{ $position->name }}</td>
                                <td class="border">
                                    <ul>
                                    @foreach($election->officers->where('position_id', $position->id) as $officer)
                                        <li class="py-2">{{ $officer->user->first_name . ' ' . $officer->user->middle_name . ' ' . $officer->user->last_name . ' ' }}</li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td class="border">
                                    <ul>
                                    @foreach($election->officers->where('position_id', $position->id) as $officer)
                                        @if($officer->is_elected)
                                        <li class="text-green-500 py-2">elected</li>
                                        @else
                                        <li class="text-red-500 py-2">tie</li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center">
        @if(\App\Models\Officer::where('is_elected', 0)->exists())
        <button wire:click="confirmElection('redo')" class="inline-block bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500">Start Re-election</button>
        @else
        <button wire:click="confirmElection('end')" class="inline-block bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500">End Election</button>
        @endif
    </div>

    {{-- CONFIRMATION MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="confirmationModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
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
                            {{-- @foreach($elections as $election)
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
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeConfirmationModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="endElection" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    {{-- CONFIRMATION MODAL --}}

    {{-- NEW ELECTION MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="newElectionModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8 mb-3">Do you want to end the election? Students will not be able to vote anymore once you proceed</p>
                    <h1 class="font-bold text-center mb-2">Redo Election</h1>
                    <table class="w-full border-collapse border border-black">
                        <thead>
                            <tr>
                                <th class="border-black border">Name</th>
                                <th class="border-black border">Positon</th>
                                <th class="border-black border">Tied Candidates</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($elections as $election)
                                @if($election->officers()->where('is_elected', 0)->exists())
                                <tr>
                                    <td class="border-black border py-2 px-1">
                                        {{ $election->name }}
                                    </td>
                                    <td class="border-black border py-2 px-1">
                                        <ul>
                                            @foreach($positions as $position)
                                            @if($election->officers()->where('is_elected', 0)->where('position_id', $position->id)->exists())
                                            <li>{{ $position->name }}</li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="border-black border py-2 px-1">
                                        <ul>
                                            @foreach($positions as $position)
                                            @if($election->officers()->where('is_elected', 0)->where('position_id', $position->id)->exists())
                                            <li>{{ $election->officers->where('is_elected', 0)->count() }}</li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeNewElectionModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="startNewElection" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    {{-- NEW ELECTION MODAL --}}
</div>
