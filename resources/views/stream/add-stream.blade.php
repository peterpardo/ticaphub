<x-app-layout>
    <section class="mt-5 max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Add Stream</h2>

        <form action="{{ route('store.stream') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6 mt-4">
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Stream Title</label>
                    <input name="title" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('title')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200">Description</label>
                    <textarea name="description" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"></textarea>
                    @error('description')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label class="text-gray-700 dark:text-gray-200">Facebook Stream Link</label>
                    <input name="stream" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('stream')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button class="px-6 py-2 leading-5 text-white bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Save</button>
            </div>
        </form>
    </section>
</x-app-layout>
