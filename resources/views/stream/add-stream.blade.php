<x-app-layout>
	<h1 class="font-bold text-center text-3xl my-4">Add Stream</h1>
    <div class="w-full text-gray-800">
            <form action="{{ route('store.stream') }}" method="POST" enctype="multipart/form-data"
            class="w-96 mx-auto bg-white rounded shadow px-4 py-2">
            @csrf

                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Stream Title</label>
                    <input type="text" name="title"class="rounded w-full text-black dark:text-gray-900" placeholder="Enter Name">
                    @error('title')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Stream Description</label>
                    <textarea name="description" class="rounded w-full text-black dark:text-gray-900" rows="3"></textarea>
                    @error('description')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-3">
                    <label class="font-semibold text-base text-gray-900 dark:text-gray-900">Stream Link</label>
                    <input type="text" name="stream"class="rounded w-full text-black dark:text-gray-900" placeholder="Embeded Link">
                    @error('stream')
                    <div class="text-xs font-semibold leading-tight text-red-700 rounded-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-evenly my-3 text-gray-800">
                    <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">Submit</button>
                </div>

            </form>
        </div>
</x-app-layout>
