<div>
    <div class="flex justify-between my-4">
        <div>
            <a href="{{ route('add-student') }}" class="inline-block md:w-32 bg-green-600 dark:bg-green-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-green-500 dark:hover:bg-green-200 transition ease-in-out duration-300">+ Student</a>
            <a href="{{ route('add-admin') }}" class="inline-block md:w-32 bg-indigo-600 dark:bg-indigo-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-indigo-500 dark:hover:bg-indigo-200 transition ease-in-out duration-300">+ Admin</a>
            <a href="{{ route('add-panelist') }}" class="inline-block md:w-32 bg-yellow-600 dark:bg-yellow-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-yellow-500 dark:hover:bg-yellow-200 transition ease-in-out duration-300">+ Panelist</a>
        </div>
        <button wire:click="resetUserBtn" class="inline-block md:w-auto bg-red-600 dark:bg-red-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-red-500 dark:hover:bg-red-200 transition ease-in-out duration-300" id="modal-btn">Reset Users</button>
    </div>
     {{-- STUDENT TABLE --}}
     <input type="text" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-white-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none mb-4" autocomplete="off" placeholder="Search Student" wire:model.debounce.350ms="search">
     <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="table-auto w-full">
            <thead>
            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
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
                    <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
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
                @foreach($user->getRoleNames() as $role)
                {{ $role }} |
                @endforeach
                </td>
                <td class="px-4 text-md border text-center">
                    <div class="grid grid-rows-1 mx-auto w-full justify-center text-center">
                        <a href="/users/{{ $user->id }}/edit-user" class="w-24 rounded shadow px-2 py-1 my-0.5 text-white bg-blue-500 hover:bg-blue-600">View/Edit</a>      
                        <button wire:click="selectUser({{ $user->id }})" class="w-24 rounded shadow px-2 py-1 my-0.5 text-white bg-red-500 hover:bg-red-600">Delete</button>      
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="my-2 mx-1">
            {{ $users->links() }}
        </div>
    </div>
    {{-- STUDENT TABLE --}}

    {{-- UPDATE USER MODAL --}}
    {{-- <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="userFormModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div>
                <h1 class="text-center text-2xl font-bold">Edit User</h1>
                @livewire('user-form')
            </div>
        </div>
    </div> --}}
    {{-- UPDATE USER MODAL --}}

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
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="resetFormModal">
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
                        <li><span class="font-semibold text-black">Uploaded files from each capston group</span> will be archived</li>
                        <li><span class="font-semibold text-black">List of officers</span> will be generated and archived</li>
                        <li><span class="font-semibold text-black">List of committees</span> will be generated and archived</li>
                        <li><span class="font-semibold text-black">Created rubrics for each award</span> will be archived</li>
                        <li><span class="font-semibold text-black">Capstone group winners</span> will be archived (including all the certificates)</li>
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
