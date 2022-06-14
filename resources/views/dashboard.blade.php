<x-app-layout :scripts="$scripts" title="Dashboard" x-data="setTicap()">
    {{--
        scripts - set needed scripts for this view from its respective controller
        title - set title of the page (Ex: Dashboard)
    --}}
    <div class="text-gray-800 dark:text-white mt-6 text-center">
        <button @click.prevent="isOpen = true" class="inline-block text-white text-xl bg-green-500 hover:bg-green-600 px-5 py-2 rounded">Set TICaP</button>
    </div>

    <div class="min-w-screen h-screen flex animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" x-cloak x-show="isOpen">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <div>
                <form
                    action="/set-ticap"
                    method="post">
                @csrf

                <div class="text-gray-800 text-center p-5 flex-auto justify-center">
                    <label class="block font-semibold text-2xl mb-3 text-gray-800">Set TICaP</label>
                    <input type="text" @keydown="showMessage = false; message = ''" x-model="ticap" @keyup.enter="addTicap()" class="rounded w-full text-center" placeholder="Enter TICaP name">
                    <div x-show="showMessage" x-text="message" class="mt-3 text-xs font-semibold leading-tight text-red-700 rounded-sm"></div>

                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                        <a href="javascript;" @click.prevent="closeModal()" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</a>
                        <button @click.prevent="addTicap()" class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
