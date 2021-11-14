<x-app-layout>
    <section class="mt-5 max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Add TICaP Events</h2>

        <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-6 mt-4">
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Brand Image</label>
                    <input type="file" name="image" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('image')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110  px-6 py-2 leading-5 text-white bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Save</button>
            </div>
        </form>
    </section>
</x-app-layout>
