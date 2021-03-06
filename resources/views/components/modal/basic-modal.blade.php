<div x-cloak x-show="{{ $isOpen }}" class ='min-w-screen h-screen animated fadeIn faster fixed flex justify-center items-center inset-0 z-50 outline-none focus:outline-none'>
    <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
    <div class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
        <!--content-->
        <div>
            <!--body-->
            <div class="text-center p-5 flex-auto justify-center text-gray-800">
                {{ $icon }}
                <h2 class="text-xl font-bold py-4">{{ $title }}</h3>
                <p class="text-sm text-gray-500 px-8">{{ $description }}</p>
            </div>
            <!--footer-->
            <div class="p-3 mt-2 text-center space-x-4 md:block">
                <button  @click.prevent="{{ $closeModal }}" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                <button @click.prevent="{{ $submitModal }}" class="mb-2 md:mb-0 bg-{{ $btnColor }}-500 border border-{{ $btnColor }}-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-{{ $btnColor }}-600">{{ $btnName }}</button>
            </div>
        </div>
    </div>
</div>

