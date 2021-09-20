<x-app-layout>
    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div>
        <div class="text-center">
            <h1 class="font-bold text-4xl mb-3">{{ $ticap }}</h1>
            <h1 class="font-semibold text-3xl">Election Panel</h1>
        </div>

        <form 
        action="{{ route('new-election') }}" 
        method="post">
        @csrf

        @if(session('error'))
        <div class="text-red-500 text-center my-5">{{ session('error') }}</div>
        @endif

        <div class="flex flex-wrap justify-evenly w-full">
            {{-- VOTES TALLY FOR EACH SPECIALIZATION - START --}}
            @foreach(\App\Models\School::all() as $school)
                @if($school->is_involved)
                <div class="w-2/5">
                    <h1 class="text-2xl font-semibold">{{ $school->name }}</h1>
                    
                    @foreach(\App\Models\Specialization::all() as $specialization)
                    <div>

                        <div class="mb-3">
                            <h1 class="text-xl">{{ $specialization->name }}</h1>
                            <p>{{ \App\Models\UserSpecialization::all()->where('specialization_id', $specialization->id)->where('has_voted', 1)->count() }} out of {{ \App\Models\UserSpecialization::all()->where('specialization_id', $specialization->id)->count() }} has voted</p>
                        </div>
                        
                        <table class="w-full rounded-lg shadow-lg mx-1 text-center my-3">
                            
                            <thead>
                                <tr class="bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">Position</th>
                                    <th class="px-4 py-3">Officer</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            
                            <tbody class="bg-white">
                                @foreach(\App\Models\Position::all() as $position)
                                <tr>
                                    
                                    <td class="border">{{ $position->name }}</td>

                                    <td class="border">
                                        <ul>
                                        @foreach($officers as $officer)
                                            @if(
                                                $officer->user->candidate->specialization->id == $specialization->id &&
                                                $officer->user->candidate->position->id == $position->id
                                            )
                                                <li class="py-2">{{ $officer->user->first_name . ' ' . $officer->user->middle_name . ' ' . $officer->user->last_name . ' ' }}</li>
                                            @endif
                                        @endforeach
                                        </ul>
                                    </td>

                                    <td class="border">
                                        <ul>
                                        @foreach($officers as $officer)
                                            @if(
                                                $officer->user->candidate->specialization->id == $specialization->id &&
                                                $officer->user->candidate->position->id == $position->id
                                            )
                                                @if($officer->is_elected)
                                                <li class="text-green-500 py-2">elected</li>
                                                @else
                                                <li class="py-2">{{ \App\Models\Vote::where('candidate_id', $officer->user->candidate->id)->count() }}</li>
                                                @endif
                                            @endif
                                        @endforeach
                                        </ul>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>

                    </div>
                    @endforeach
                    
                </div>
                @endif
            @endforeach
            {{-- VOTES TALLY FOR EACH SPECIALIZATION - END --}}
        </div>
            
            <div class="text-center">
                
                <div class="text-center">
                
                    <button type="submit" class="bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500">Get Election Results</button>
                    
                </div>
                
            </div>
        </form>

    </div>
</x-app-layout>