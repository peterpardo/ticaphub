<x-app-layout>
    <x-page-title>{{ $title }}</x-page-title>
    <h1 class="font-bold text-4xl mb-2 text-center">{{ $ticap->name }}</h1>
    <h1 class="text-center text-2xl mb-3">Election of Officers</h1>
    <h1 class="text-center text-xl mb-3">{{ $election->name }}</h1>
    @can('appoint committee head')
    <a href="/officers-and-committees/appoint" class="inline-block bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1">Appoint Committee Heads</a>
    @endcan
    <div class="flex flex-wrap justify-evenly w-full">
        <div class="w-2/5">
            <table class="w-full rounded-lg shadow-lg mx-1 text-center my-3">
                <thead>
                    <tr class="bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Position</th>
                        <th class="px-4 py-3">Officer</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($positions as $position)
                    <tr>  
                        <td class="border">{{ $position->name }}</td>
                        <td class="border">
                            @if(!$ticap->election_finished && !$user->userElection->has_voted)
                                none
                            @elseif(!$ticap->election_finished && $user->userElection->has_voted)
                                wait for results
                            @else
                                officer name
                                {{-- @foreach($officers as $officer)
                                    @if(
                                        $officer->user->candidate->specialization->id == $specialization->id &&
                                        $officer->user->candidate->position->id == $position->id
                                    )
                                        {{ $officer->user->first_name . ' ' . $officer->user->middle_name . ' ' . $officer->user->last_name . ' ' }}
                                    @endif
                                @endforeach --}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>