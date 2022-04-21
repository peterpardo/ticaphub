<div>
    <a href="{{ route('set-rubrics') }}"
        class="inline-flex mb-3 rounded shadow px-2 py-2 text-white bg-red-500 hover:bg-red-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                clip-rule="evenodd" />
        </svg>
        <span>Back</span>
    </a>
    <div class="text-center my-2 font-semibold text-3xl">Set Panelists</div>

    @if (session('status'))
        <div class="text-center bg-{{ session('status') }}-100 border-l-4 border-{{ session('status') }}-500 text-{{ session('status') }}-700 p-4"
            role="alert">
            <p class="font-bold">{{ session('message') }}</p>
        </div>
    @endif

    <div class="flex justify-between">
        <a href="/set-panelist/assign"
            class="inline-block mb-3 rounded shadow px-2 py-2 text-white bg-green-500 hover:bg-green-600">Insert
            Panelist</a>
        <a href="/award-review"
            class="inline-block mb-3 rounded shadow px-2 py-2 text-white bg-blue-500 hover:bg-blue-600">Review Award
            Settings</a>
    </div>

    {{-- SPECIALIZATION PANELIST TABLE --}}
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <table class="w-full table-fixed">
            <thead>
                <tr
                    class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Specializations</th>
                    <th class="px-4 py-3">Panelists</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($specializations as $spec)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-xl font-bold border">
                            {{ $spec->name . ' (' . $spec->school->name . ')' }}</td>
                        <td class="px-4 py-3 text-md border">
                            @if (!$spec->panelists()->exists())
                                <div class="bg-gray-100 py-5 rounded text-center">No panelist assigned yet</div>
                            @else
                                <table class="table-fixed">
                                    @foreach ($spec->panelists as $panelist)
                                        <tr>
                                            <td class="px-2 py-1">{{ $panelist->user->first_name }}
                                                {{ $panelist->user->middle_name }} {{ $panelist->user->last_name }}
                                            </td>
                                            <td class="px-2 py-1"><button
                                                    wire:click="deletePanelist({{ $panelist->user->id }})"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-2 rounded">&times;</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- SPECIALIZATION PANELIST TABLE --}}

    {{-- DELETE POSITION MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none"
        id="deletePanelistModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div>
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                        <p class="text-sm text-gray-500 px-8">Do you really want to delete the position? This process
                            cannot be undone.</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeDeleteModal"
                        class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="delete"
                        class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE POSITION MODAL --}}
</div>
