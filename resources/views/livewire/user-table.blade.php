<div>
    <div x-data="{ isOpen: false }" class="flex justify-end">
        <div class="inline-block">
            <!-- Dropdown toggle button -->
            <button @click.prevent="isOpen = !isOpen" @click.away="isOpen = false" class="flex items-center z-10 p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none">
                <span class="mx-1">Actions</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div x-cloak x-show="isOpen" class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800">
                <a href="{{ route('add-student') }}" class="flex w-full items-center cursor-pointer px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span class="mx-1">
                        Add Student
                    </span>
                </a>

                <a href="{{ route('add-admin') }}" class="flex w-full items-center cursor-pointer px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span class="mx-1">
                        Add Admin
                    </span>
                </a>

                <a href="{{ route('add-panelist') }}" class="flex w-full items-center cursor-pointer px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span class="mx-1">
                        Add Panelist
                    </span>
                </a>

                <hr class="border-gray-200 dark:border-gray-700">

                <a href="/users/groups" class="flex w-full items-center cursor-pointer px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>

                    <span class="mx-1">
                        Capstone Groups
                    </span>
                </a>

                <hr class="border-gray-200 dark:border-gray-700">

                <button wire:click.prevent="resetUserBtn" class="flex items-center w-full cursor-pointer px-3 py-3 text-sm text-gray-600 dark:text-white capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>

                    <span class="mx-1">
                        Reset Users
                    </span>
                </button>
            </div>
        </div>
    </div>
    {{-- <div class="flex justify-between my-4">
        <div>
            <a href="{{ route('add-student') }}" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 inline-block md:w-32 bg-green-600 dark:bg-green-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-green-500 dark:hover:bg-green-200">+ Student</a>
            <a href="{{ route('add-admin') }}" class="ml-auto sm:ml-3 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110    inline-block md:w-32 bg-indigo-600 dark:bg-indigo-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-indigo-500 dark:hover:bg-indigo-200">+ Admin</a>
            <a href="{{ route('add-panelist') }}" class="ml-auto sm:ml-3 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110     inline-block md:w-32 bg-yellow-600 dark:bg-yellow-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-yellow-500 dark:hover:bg-yellow-200">+ Panelist</a>
        </div>
        <button wire:click="resetUserBtn" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 inline-block md:w-auto bg-red-600 dark:bg-red-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-red-500 dark:hover:bg-red-200" id="modal-btn">Reset Users</button>
    </div> --}}
     {{-- STUDENT TABLE --}}
     <input type="text" class="text-gray-800 w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-white-800 border border-gray-400 dark:border-gray-700 font-semibold focus:border-blue-500 focus:outline-none mb-4" autocomplete="off" placeholder="Search Student" wire:model.debounce.350ms="search">
     <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3">Student Name</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Role</th>
                <th class="px-4 py-3">Action</th>
            </tr>
            </thead>
            <tbody class="w-auto bg-white text-center">
            @foreach($users as $user)
            <tr class="text-gray-700">
                <td class="px-4 border">
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
                <td class="px-4 text-md font-semibold border">
                    {{ $user->email }}
                </td>
                <td class="px-4 text-md font-semibold border">
                @if($user->email_verified)
                <span class="rounded-md px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100">email verified</span>

                @else
                <span class="rounded-md px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100">not verified</span>
                @endif
                </td>
                <td class="px-4 text-md font-semibold border">
                    <div class="divide-x-2 divide-black">
                        @foreach($user->getRoleNames() as $role)
                        <span class="inline-block px-1 text-center">
                            {{ $role }}
                        </span>
                        @endforeach
                    </div>
                </td>
                <td class="px-4 text-md border text-center">
                    <div class="grid grid-rows-1 mx-auto w-full justify-center text-center">
                        <a href="/users/{{ $user->id }}/edit-user" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110  w-24 rounded shadow px-2 py-1 my-0.5 text-white bg-blue-500 hover:bg-blue-600">View/Edit</a>
                        <button wire:click="selectUser({{ $user->id }})" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110  w-24 rounded shadow px-2 py-1 my-0.5 text-white bg-red-500 hover:bg-red-600">Delete</button>
                    </div>
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


    {{-- DELETE USERS MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="modalFormDelete">
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
                    <h2 class="text-xl font-bold py-4">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8">Do you really want to delete the user? This process cannot be undone</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="deleteUser" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE USERS MODAL --}}

    {{-- RESET MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster fixed left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="resetFormModal">
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
                    <p class="text-sm text-gray-500 px-8 mb-2">Do you really want to reset all users? Resetting all the users will have the following effect:</p>
                    <ul class="list-inside list-decimal text-left text-sm text-gray-500">
                        <li><span class="font-semibold text-black">Uploaded files from the events</span> will be archived</li>
                        <li><span class="font-semibold text-black">Uploaded files from each capstone group</span> will be archived</li>
                        <li><span class="font-semibold text-black">List of officers</span> will be archived</li>
                        <li><span class="font-semibold text-black">List of committees</span> will be archived</li>
                        <li><span class="font-semibold text-black">List of panelists</span> will be archived</li>
                        <li><span class="font-semibold text-black">Graded rubrics for each award</span> will be archived</li>
                        <li><span class="font-semibold text-black">Capstone group winners</span> will be archived</li>
                    </ul>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeResetModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="resetUsers" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Reset</button>
                </div>
            </div>
        </div>
    </div>
    {{-- RESET MODAL --}}
</div>
