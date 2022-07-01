<div {{ $attributes }} class="min-w-screen h-screen fixed flex justify-center items-center py-5 inset-0 z-50 outline-none focus:outline-none">
    <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
    <div class="w-full overflow-y-auto max-h-full transition-all duration-300 max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white space-y-4">
        {{ $slot }}
    </div>
</div>
