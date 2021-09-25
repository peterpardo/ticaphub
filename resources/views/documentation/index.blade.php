<x-app-layout>
    <x-page-title>{{ $title }}</x-page-title>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3">Ticap Name</th>
                <th class="px-4 py-3">Created at</th>
                <th class="px-4 py-3">Action</th>
            </tr>
            </thead>
            <tbody class="w-auto bg-white">
            @foreach($ticaps as $ticap)
            <tr class="text-gray-700">
                <td class="px-4 py-3 text-md font-semibold border">
                    {{ $ticap->name }}
                </td>
                <td class="px-4 py-3 text-md font-semibold border">
                    {{ $ticap->created_at->format('F j, Y, g:i a') }}
                </td>
                <td class="px-4 py-3 text-md font-semibold border">
                    <a href="documentation/{{ $ticap->id }}" class="inline-block bg-green-500 hover:bg-green-600 text-white rounded px-2 py-1">View files</a>
                </td>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</x-app-layout>