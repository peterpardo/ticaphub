<div {{ $attributes }} class ='min-w-screen h-screen animated fadeIn faster fixed flex justify-center items-center inset-0 z-50 outline-none focus:outline-none'>
    <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
    <div class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
        <!--content-->
        <div>
            <!--body-->
            <div class="text-center p-5 flex-auto justify-center text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <h2 class="text-xl font-bold py-4">
                    {{ $title }}
                </h3>
                <p class="text-sm text-gray-500 px-8">
                    {{ $description }}
                </p>
            </div>
            <!--footer-->
            <div class="p-3 mt-2 text-center space-x-4 md:block">
                <button type="button" wire:click="closeModal('delete')" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                <button type="button" wire:click="deleteItem" class="mb-2 md:mb-0 bg-red-600 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
            </div>
        </div>
    </div>
</div>

