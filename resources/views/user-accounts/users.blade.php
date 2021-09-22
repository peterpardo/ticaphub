<x-app-layout :scripts="$scripts">
    <x-page-title>
        {{ $title }}
    </x-page-title>
    <div class="flex justify-between my-2">
        <div>
            <a href="{{ route('add-student') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">+ Student</a>
            <a href="{{ route('add-admin') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">+ Admin</a>
            <a href="{{ route('add-panelist') }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full">+ Panelist</a>
        </div>
        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" id="modal-btn">Reset Users</button>
    </div>
    @if($users->isEmpty())
    <div class="font-extrabold text-4xl">
        Add Users
    </div>
    @else
    {{-- <section class="container mx-auto p-6">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="card-body p-5">
                @livewire('filter')
            </div>
        </div>
    </section> --}}
    @endif

    {{-- DELETE USERS MODAL OVERLAY --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="modal-overlay">
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
                    <p class="text-sm text-gray-500 px-8">Do you really want to reset all users? This process cannot be undone</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <form 
                        action="{{ route('reset-users') }}" 
                        method="POST">
                        @csrf
                        <a href="javascript:;" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                        <button type="submit" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
