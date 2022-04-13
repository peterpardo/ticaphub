<div>
    {{-- Error Message --}}
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-2" role="alert">
            <strong class="font-bold">{{ session('error') }}</strong>
        </div>
    @endif
    {{-- Error Message --}}

    {{-- Schools --}}
    <div class="flex justify-between my-5">
        <h1 class="font-bold text-2xl">Schools</h1>

        <button wire:click="openConfirmationModal"
            class="font-bold rounded shadow px-5 py-2 text-white bg-green-500 hover:bg-green-600">
            START TICAP
        </button>
    </div>

    <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr
                        class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">School</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>

                <tbody class="w-auto bg-white text-center">
                    @foreach ($schools as $school)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-md font-semibold border">
                                {{ $school->name }}
                            </td>

                            <td class="text-center px-4 py-3 text-md font-semibold border">
                                {{-- Check if school is involved in current ticap --}}
                                @if ($school->is_involved)
                                    <span
                                        class="rounded-md px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100">included</span>
                                @else
                                    <span
                                        class="rounded-md px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100">not
                                        included</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-md border">
                                <div class="text-center px-4 py-3 text-md font-semibold">
                                    {{-- Check if school is involved in current ticap --}}
                                    @if ($school->is_involved)
                                        @if ($school->id == 1)
                                            <span
                                                class="inline-block rounded shadow px-4 sm:px-7 py-1 my-0.5 text-white bg-green-500 w-32">Included</span>
                                        @else
                                            <button wire:click="removeSchool({{ $school->id }})"
                                                class="rounded shadow px-4 sm:px-7 py-1 my-0.5 text-white bg-red-500 hover:bg-red-600 w-32">Remove</button>
                                        @endif
                                    @else
                                        <button wire:click="addSchool({{ $school->id }})"
                                            class="rounded shadow px-4 sm:px-7 py-1 my-0.5 text-white bg-green-500 hover:bg-green-600 w-32">Add</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Schools --}}

    {{-- Specializations --}}
    <h1 class="font-bold text-2xl my-4">Specializations</h1>
    <label class="font-semibold block mb-2">Add Specializtion</label>

    {{-- Alert Message --}}
    @if (session('status'))
        <div class="bg-{{ session('status') }}-100 border-l-4 border-{{ session('status') }}-500 text-{{ session('status') }}-700 p-4 mb-2"
            role="alert">
            <p class="font-bold">{{ session('message') }}</p>
        </div>
    @endif

    {{-- Specialization Form --}}
    <form wire:submit.prevent='addSpecialization' class="flex flex-wrap mt-5 sm:mt-0">
        <div class="mr-2 text-gray-800">
            <select wire:model="selectedSchool" class="rounded block">
                <option value="">-- select school --</option>
                @foreach ($involvedSchools as $involvedSchool)
                    <option value="{{ $involvedSchool->id }}">{{ $involvedSchool->name }}</option>
                @endforeach
            </select>
            <div class="mt-5">
                @error('selectedSchool')
                    <span class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-2"
                        role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mr-2 text-gray-800">
            <input type="text" wire:model="specialization" class="rounded block" placeholder="Specialization name">
            <div class="mt-5">
                @error('specialization')
                    <span class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-2"
                        role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <button type="submit" class="text-white bg-green-500 hover:bg-green-600 rounded px-5 py-2">Add</button>
        </div>
    </form>

    <div class="mt-5 bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr
                        class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">School</th>
                        <th class="px-4 py-3">Specialization</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>

                </thead>
                <tbody class="w-auto bg-white">
                    @foreach ($specs as $spec)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-md font-semibold border">
                                {{ $spec->school->name }}
                            </td>

                            <td class="px-4 py-3 text-md font-semibold border">
                                {{ $spec->name }}
                            </td>

                            <td class="px-4 py-3 text-md border">
                                <div class="flex flex-col w-1/2 mx-auto text-center">
                                    <button wire:click="selectSpec({{ $spec->id }}, 'update')"
                                        class="rounded shadow px-2 py-1 my-0.5 w-24 text-white bg-blue-500 hover:bg-blue-600">Edit</button>
                                    <button wire:click="selectSpec({{ $spec->id }}, 'delete')"
                                        class="rounded shadow px-2 py-1 my-0.5 w-24 text-white bg-red-500 hover:bg-red-600">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Specializations --}}

    {{-- Modals --}}

    {{-- CONFIRMATION MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none"
        id="confirmationModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div>
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center text-gray-800">
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                        <p class="text-sm text-gray-500 px-8 mb-5">Do you want to start the TICaP with these settings?
                            You will not be able to change it once you proceed.</p>
                        <h1 class="font-bold text-center mb-2">TICaP Settings</h1>
                        <table class="w-full border-collapse border border-black">
                            <thead>
                                <tr>
                                    <th class="border-black border">School</th>
                                    <th class="border-black border">No. of Specializations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($involvedSchools as $school)
                                    <tr>
                                        <td class="border-black border">{{ $school->name }}</td>
                                        <td class="border-black border">{{ $school->specializations->count() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeConfirmationModal"
                        class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="setInvitation"
                        class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    {{-- CONFIRMATION MODAL --}}

    {{-- UPDATE SPEC MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none"
        id="updateSpecModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div>
                @livewire('specialization-form')
            </div>
        </div>
    </div>
    {{-- UPDATE SPEC MODAL --}}

    {{-- DELETE SPEC MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none"
        id="deleteSpecModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div>
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
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
                        <p class="text-sm text-gray-500 px-8">Do you really want to delete the specialization? This
                            process cannot be undone</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeDeleteModal"
                        class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="deleteSpec"
                        class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE SPEC MODAL --}}
</div>
