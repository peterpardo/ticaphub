<x-app-layout>
    <h1 class="font-bold text-3xl my-3">Home Stream</h1>
    <div class="flex justify-between my-4">
        <a href="{{ route('add.stream') }}" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 inline-block md:w-32 bg-green-600 dark:bg-green-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-green-500 dark:hover:bg-green-200">+ Stream</a>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">No.</th>
                    <th class="px-4 py-3">Stream Title</th>
                    <th class="px-4 py-3">Stream Description</th>
                    <th class="px-4 py-3">Facebook Stream Link</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
                </thead>
                <tbody class="w-auto bg-white text-center dark:text-gray-800">
                    @php($i = 1)
                @foreach($streams as $stream)
                <tr class="text-gray-700">
                    <th class="px-4 py-3 border">{{ $i++ }}</th>
                    <td class="px-4 py-3 border">{{ $stream->title }}</td>
                    <td class="px-4 py-3 border">{{ $stream->description }}</td>
                    <td class="px-4 py-3 border">{{ $stream->stream_link }}</td>
                    <td class="px-4 py-3 border">
                        <a class="rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600" href="{{ url('stream/delete/'.$stream->id) }}" onclick="return confirm('Are you sure to delete?')">Delete</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
