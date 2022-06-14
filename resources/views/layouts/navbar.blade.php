<div class="fixed top-0 left-0 w-screen flex items-center bg-white filter drop-shadow-md h-14 z-10 px-5">
    <div class="ml-auto flex w-full justify-between items-center">
        <h1 class="ml-14 font-bold text-3xl transition-all duration-300 md:ml-64">{{ $title }}</h1>

        <div class="relative block" x-data="{ open: false }">
            <!-- Dropdown toggle button -->
            <button type="button" @click.prevent="open = !open" class="relative z-10 flex items-center p-2 text-sm text-gray-600 bg-white border border-transparent rounded-md focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:text-white dark:bg-gray-800 focus:outline-none">
                <span class="mx-1">Hello, {{ Auth::user()->first_name }}!</span>
                <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 15.713L18.01 9.70299L16.597 8.28799L12 12.888L7.40399 8.28799L5.98999 9.70199L12 15.713Z" fill="currentColor"></path>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div x-cloak x-show="open" @click.outside="open = false" class="absolute top-9 right-0 z-20 w-56 py-2 mt-2 overflow-hidden bg-white rounded-md shadow-xl dark:bg-gray-800">
                {{-- User Image and Name --}}
                <div class="flex items-center p-3 -mt-2 text-sm text-gray-600 transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                    <img
                        class="flex-shrink-0 object-cover mx-1 rounded-full w-9 h-9"
                        src="
                            @if (is_null(Auth::user()->profile_picture))
                                {{ url(asset('assets/default-img.png')) }}
                            @else
                                {{ Storage::url(Auth::user()->profile_picture) }}
                            @endif
                        "
                        alt="user_avatar">
                    <div class="mx-1">
                        <h1 class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <hr class="border-gray-200 dark:border-gray-700 ">

                {{-- View/Manage Profile --}}
                <a href="{{ route('profile.update') }}" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                    view profile
                </a>

                <hr class="border-gray-200 dark:border-gray-700 ">

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        Sign Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

