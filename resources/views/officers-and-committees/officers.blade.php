<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="font-bold text-4xl mb-2 text-center">{{ $ticap->name }}</h1>
    <h1 class="text-center text-2xl mb-3">Election of Officers</h1>
    @can('generate report')
        @if($ticap->election_finished)
            <a href="/generate-officers" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded my-3">Generate Report</a>
        @endif
    @endcan
    <div class="flex flex-wrap justify-evenly w-full">
    @foreach($elections as $election)
        <div class="w-2/5">
            @if(session('status'))
                <div class="bg-{{ session('status') }}-500 my-2 text-center px-2 py-1 rounded text-white">{{ session('message') }}</div>
            @endif
            <h1 class="text-xl text-center font-semibold">{{ $election->name }}</h1>
            <div>
                <table class="table-auto w-full">    
                    <thead>
                        <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Position</th>
                            <th class="px-4 py-3">Officer</th>
                        </tr>
                    </thead>
                    <tbody class="w-auto bg-white text-center">
                        @foreach($positions as $position)
                        <tr class="text-gray-900">
                            <td class="px-4 border">{{ $position->name }}</td>
                            @if($ticap->election_finished)
                                @foreach($election->officers->where('position_id', $position->id) as $officer)
                                <td class="px-4 border">{{ $officer->user->first_name . ' ' . $officer->user->middle_name . ' ' . $officer->user->last_name . ' ' }}</td>
                                @endforeach
                            @elseif($ticap->election_has_started)
                                <td class="px-4 border">Waiting for results</td>
                            @else
                                <td class="px-4 border">None</td>
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