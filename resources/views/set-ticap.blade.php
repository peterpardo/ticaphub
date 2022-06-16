<x-app-layout
    showSidebar="{{ false }}"
    x-data="{
        isOpen: false,
        ticap: '',
        message: 'error',
        showMessage: '',
    }">

    {{-- Set ticap button --}}
    <div class="text-gray-800 dark:text-white mt-6 text-center">
        <button @click.prevent="isOpen = true" class="inline-block font-semibold text-white text-lg drop-shadow-lg filter bg-red-800 hover:bg-red-700 hover:text-white px-5 py-2 rounded">Set TICaP</button>
    </div>

    {{-- Set ticap modal --}}
    <x-modal.input-modal
        title="set ticap"
        btnColor="green"
        btnName="set ticap"
        closeModal="closeModal"
        submitModal="await addTicap"
        isOpen="isOpen"
    >
        <x-slot name="icon">
            <svg class="w-16 h-16 flex items-center text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
        </x-slot>

        <x-slot name="body">
            <input type="text" name="ticap" x-model="ticap" @click.prevent="showMessage=false" class="rounded w-full text-center" placeholder="Enter TICaP name" autocomplete="off">
            <div x-show="showMessage" x-text="message" class="mt-2 text-sm font-semibold leading-tight text-red-700 bg-red-100 p-2 rounded-sm"></div>
            <span class="block p-1 text-gray-500 bg-gray-100 rounded text-sm mt-2">Note: Make sure the TICaP name is unique</span>
        </x-slot>
    </x-modal.input-modal>

    {{-- Scripts --}}
    @push('scripts')
        <script src="{{ asset('js/set-ticap/set-ticap.js') }}"></script>
    @endpush
</x-app-layout>
