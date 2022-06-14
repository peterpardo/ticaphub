 <div class="bg-red-700 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-red-800 dark:border-gray-600 text-white font-medium group">
    {{-- Card Icon/Image --}}
    <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
        {{ $icon }}
    </div>

    {{-- Card Details --}}
    <div class="text-right">
        <p class="text-2xl">{{ $count }}</p>
        <p class="capitalize">{{ $name }}</p>
    </div>
</div>
