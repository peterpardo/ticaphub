<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <table class="w-full mb-3">
        <thead>
            <tr>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Panelists</td>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach($panelists as $panelist)
                <tr>
                    <td class="px-2 py-2 text-lg border">{{ $panelist->user->first_name }} {{ $panelist->user->middle_name }} {{ $panelist->user->last_name }}</td>
                    <td class="px-2 py-2 text-lg border">
                        @if($panelist->is_done)
                            <span class="text-green-500">done</span>
                        @else
                        <span class="text-red-500">evaluating</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1 class="text-xl font-semibold mb-2">Results</h1>
    <div class="bg-gray-100 py-5 text-center rounded">Waiting for Results</div>
</x-app-layout>