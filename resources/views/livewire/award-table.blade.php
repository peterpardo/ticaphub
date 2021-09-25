<div>
    <div class="text-left my-2 font-semibold text-3xl">Create Awards</div>
    <button wire:click="addAwardForm" class="inline-block md:w-auto bg-green-600 dark:bg-green-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-green-500 dark:hover:bg-green-200 transition ease-in-out duration-300">Add Award</button>
    {{-- STUDENT TABLE --}}
    <div class="text-center my-2 font-semibold text-3xl">List of Awards</div>
    <input type="text" wire:model.debounce.350ms="search" class="rounded mb-2" placeholder="search award">
    <select wire:model="selectedSchool" class="rounded font-semibold text-base text-gray-900 dark:text-gray-900">
        <option value="">-- select school --</option>
        @foreach($schools as $school)
        <option value="{{ $school->id }}">{{ $school->name }}</option>
        @endforeach
    </select>
    <select wire:model="selectedSpec" class="rounded font-semibold text-base text-gray-900 dark:text-gray-900">
        <option value="">-- select specialization --</option>
        @foreach($specializations as $spec)
        <option value="{{ $spec->id }}">{{ $spec->name }}</option>
        @endforeach
    </select>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3">Award Name</th>
                <th class="px-4 py-3">Award Type</th>
                <th class="px-4 py-3">School</th>
                <th class="px-4 py-3">Specialization</th>
                <th class="px-4 py-3">Action</th>
            </tr>
            </thead>
        <tbody class="bg-white">
            @foreach($awards as $award)
            <tr class="text-gray-700">
                <td class="px-4 py-3 text-xl font-bold border">{{ $award->name }}</td>
                <td class="px-4 py-3 text-md border">{{ $award->type }}</td>
                <td class="px-4 py-3 text-md border">{{ $award->school->name }}</td>
                <td class="px-4 py-3 text-md border">{{ $award->specialization->name }}</td>
                <td class="px-4 py-3 text-md border text-center">
                    <button wire:click="editAward({{ $award->id }})" class="w-1/2 my-1 rounded shadow px-2 py-2 text-white bg-blue-500 hover:bg-blue-600">Edit</button>
                    <button wire:click="openDeleteModal({{ $award->id }})" class="w-1/2 my-1 rounded shadow px-2 py-2 text-white bg-red-500 hover:bg-red-600">Delete</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="my-2 mx-1">
            {{ $awards->links() }}
        </div>
    </div>
    {{-- STUDENT TABLE --}}

     {{-- RESET MODAL --}}
     <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="awardFormModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                @livewire('award-form')
            </div>
        </div>
    </div>
    {{-- RESET MODAL --}}

    {{-- DELETE USERS MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="deleteAwardFormModal">
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
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8">Do you really want to delete the award? This process cannot be undone</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeDeleteModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="deleteAward" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE USERS MODAL --}}
</div>
