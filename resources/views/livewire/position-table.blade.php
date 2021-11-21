<div>
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
        <strong class="font-bold">{{ session('error') }}</strong>
      </div>
@endif
    <h1 class="font-semibold text-xl mb-2">Set Position</h1>
    <div class="flex justify-between">
        <form wire:submit.prevent='addPosition' class='mb-5'>
            <div class="mb-2">
                <input type="text" wire:model='newPosition' class="text-gray-800 rounded" placeholder="New Position Name">
                <button class="text-white rounded bg-green-500 hover:bg-green-600 px-5 py-2">Add</button>
            </div>
            @if(session('status'))
            <div class="bg-{{ session('status') }}-100 border-l-4 border-{{ session('status') }}-500 text-{{ session('status') }}-700 p-4" role="alert">
                <p class="font-bold">{{ session('message') }}</p>
              </div>
            @endif
            @error('newPosition')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">{{ $message }} </p>
              </div>
            {{-- <span class="rounded-md px-2 py-1 font-semibold leading-tight text-red-700">{{ $message }}</span> --}}
            @enderror
        </form>
        <div>
            <a class="inline-block font-bold bg-blue-500 hover:bg-blue-600 px-5 py-3 text-white rounded" href="{{ route('set-candidates') }}">Proceed to Candidates</a>
        </div>
    </div>

    <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full table-auto">
                <thead>
                    <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Position</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
                </thead>
                <tbody class="w-auto bg-white text-center">
                @foreach($positions as $position)
                <tr class="text-gray-700">
                    <td class="px-4 py-3 text-md font-semibold border">
                        {{ $position->name }}
                    </td>
                    <td class="px-4 py-3 text-md border">
                        @if($position->id == 1)
                        <span class="bg-gray-300 rounded px-2 py-1 shadow">Can't be edited</span>
                        @else
                        <button wire:click="selectPosition({{ $position->id }}, 'update')" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 rounded shadow px-2 py-1 my-0.5 text-white bg-blue-500 hover:bg-blue-600">Edit</button>
                        <button wire:click="selectPosition({{ $position->id }}, 'delete')" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 rounded shadow px-2 py-1 my-0.5 text-white bg-red-500 hover:bg-red-600">Delete</button>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

     {{-- DELETE POSITION MODAL --}}
     <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="deletePositionModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8">Do you really want to delete the position? This process cannot be undone.</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeDeleteModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="deletePosition" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE POSITION MODAL --}}

     {{-- UPDATE SPEC MODAL --}}
     <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="updatePositionModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                @livewire('position-form')
            </div>
        </div>
    </div>
    {{-- UPDATE SPEC MODAL --}}
</div>
