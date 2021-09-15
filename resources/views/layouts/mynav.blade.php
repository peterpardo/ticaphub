<!-- mobile menu -->
<div class="flex justify-between md:hidden bg-gray-800 text-white px-4 py-2">
    <!-- logo -->
    <div class="flex items-center justify-center text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span class="font-bold ml-2">TICaP Hub</span>
    </div>

    <!-- hamburger -->
    <button class="hamburger focus:outline-none focus:bg-gray-600 px-2 py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<!-- sidebar -->
<div class="sidebar w-64 bg-gray-800 text-white p-3 absolute inset-y-0 md:relative md:translate-x-0 transform -translate-x-full transition duration-200">
    <div class="flex flex-col h-full">
        <!-- logo -->
        <a class="flex items-center justify-center px-4 py-2 text-3xl text-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            
            <span class="font-bold ml-2">TICaP Hub</span>
        </a>
        
        <!-- User -->
        <div class="text-center mb-4">
            <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlcnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80" 
            alt="user"
            class="w-36 rounded-full mx-auto mb-2">
            <h3 class="text-xl">{{ Auth::user()->name }}</h3>
            <h5 class="text-sm">Role</h5>
        </div>
        
        <!-- links -->
        <nav class="flex flex-col justify-between h-full">
            <div>
                <a href="{{ route('dashboard') }}" class="block rounded px-2 py-1 bg-gray-700 hover:bg-gray-600 mb-1.5">Dashboard</a>
                <a href="{{ route('users') }}" class="block rounded px-2 py-1 bg-gray-700 hover:bg-gray-600 mb-1.5">User Accounts</a>
                {{-- <a href="#" class="block rounded px-2 py-1 bg-gray-700 hover:bg-gray-600 mb-1.5">Manage Event</a>
                <a href="#" class="block rounded px-2 py-1 bg-gray-700 hover:bg-gray-600 mb-1.5">Project Assessment</a>
                <a href="#" class="block rounded px-2 py-1 bg-gray-700 hover:bg-gray-600 mb-1.5">Set Schedule</a>
                <a href="#" class="block rounded px-2 py-1 bg-gray-700 hover:bg-gray-600 mb-1.5">Certification</a> --}}
            </div>
            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-gray-700 rounded hover:bg-gray-500 w-full">Logout</button>
                </form>
            </div>
        </nav>
    </div>

</div>
