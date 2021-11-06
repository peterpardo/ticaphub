<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="font-bold text-4xl mb-2 text-center">{{ $ticap->name }}</h1>
    <h1 class="text-center text-2xl mb-3">Election of Officers</h1>
    @can('generate report')
        @if($ticap->election_finished)
            <a href="/generate-officers" class="inline-block bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded my-3">Download Officer List</a>
        @endif
    @endcan
    <div class="flex flex-wrap justify-evenly w-full">
    @foreach($elections as $election)
        <div class="w-2/5 mb-6">
            @if(session('status'))
                <div class="bg-{{ session('status') }}-500 my-2 text-center px-2 py-1 rounded text-white">{{ session('message') }}</div>
            @endif
            <h1 class="text-xl text-center font-semibold mb-3">{{ $election->name }}</h1>
            <div>
                <table class="table-auto w-full rounded">    
                    <thead>
                        <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Position</th>
                            <th class="px-4 py-3">Officer</th>
                        </tr>
                    </thead>
                    <tbody class="w-auto bg-white text-center">
                        @foreach($positions as $position)
                        <tr class="text-gray-900">
                            <td class="px-4 border py-3">{{ $position->name }}</td>
                            @if($ticap->election_finished)
                                @foreach($election->officers->where('position_id', $position->id) as $officer)
                                <td class="px-4 border py-3">
                                    <div class="flex justify-center items-center text-sm">
                                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                        @if($officer->user->profile_picture)
                                            <img class="object-cover w-full h-full rounded-full" src="{{ Storage::url($officer->user->profile_picture) }}" alt="" loading="lazy" />
                                        @else
                                            <img class="object-cover w-full h-full rounded-full" src="{{ url(asset('assets/default-img.png')) }}" alt="" loading="lazy" />
                                        @endif
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-black text-md text-center">
                                                {{ $officer->user->first_name }} {{ $officer->user->middle_name }} {{ $officer->user->last_name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                @endforeach
                            @elseif($ticap->election_has_started)
                                <td class="px-4 border py-3">Waiting for results</td>
                            @else
                                <td class="px-4 border py-3">None</td>
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