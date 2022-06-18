<div class="min-w-screen h-screen animated fadeIn faster fixed flex justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="confirmationModal">
    <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
    <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
        <!--content-->
        <div>
            <!--body-->
            <div class="text-center p-5 flex-auto justify-center text-gray-800">
                {{ $slot }}
            </div>
            <!--footer-->
            <div class="p-3 text-center space-x-4 md:block">
                <button type="button" wire:click="closeModal('confirm')" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                <button type="button" wire:click="confirmSettings" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Proceed</button>
            </div>
        </div>
    </div>
</div>
