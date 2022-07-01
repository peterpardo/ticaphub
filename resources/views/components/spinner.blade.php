<div {{ $attributes }} class="flex justify-center items-center space-x-4">
    <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full text-green-600" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <p class="text-gray-400">{{ $slot }}</p>
</div>
