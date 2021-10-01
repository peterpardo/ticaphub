<x-app-layout>
    <x-page-title>{{ $title }}</x-page-title>
    <h1 class="font-bold text-4xl mb-2 text-center">{{ $ticap->name }}</h1>
    <h1 class="text-center text-2xl mb-3">Election of Officers</h1>
    <div class="flex flex-wrap justify-evenly w-full">
    @foreach($elections as $election)
        <div class="w-2/5">
            <h1 class="text-xl font-semibold">{{ $election->name }}</h1>
            <div>
                <table class="w-full rounded-lg shadow-lg mx-1 text-center my-3">    
                    <thead>
                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Position</th>
                            <th class="px-4 py-3">Officer</th>
                        </tr>
                    </thead>
                    <tbody class="bg-transparent dark:bg-gray-600">
                        @foreach($positions as $position)
                        <tr>
                            <td class="border">{{ $position->name }}</td>
                            @if($ticap->election_finished)
                                @foreach($election->officers->where('position_id', $position->id) as $officer)
                                <td class="border">{{ $officer->user->first_name . ' ' . $officer->user->middle_name . ' ' . $officer->user->last_name . ' ' }}</td>
                                @endforeach
                            @elseif($ticap->election_has_started)
                                <td class="border">Waiting for results</td>
                            @else
                                <td class="border">None</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
    </div>
</x-app-layout>