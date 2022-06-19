<div x-data="{ isOpen: false }" {{ $attributes->merge(['class' => 'relative']) }} style="width: fit-content">
    <!-- Dropdown toggle button -->
    <button
        @click.prevent="isOpen = !isOpen"
        @click.away="isOpen = false"
        class="flex items-center z-10 p-2 text-gray-700 bg-white border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none">
        <span class="mx-1">More</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div x-cloak x-show="isOpen" class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800">
        {{ $slot }}
    </div>
</div>
