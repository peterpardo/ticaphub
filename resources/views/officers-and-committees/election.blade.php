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
            action="{{ route('election') }}" 
            method="post">
            @csrf

        @if(session('error'))
        <div class="text-red-500 text-center my-5">{{ session('error') }}</div>
        @endif
        
        <div class="flex flex-wrap justify-evenly w-full">
            {{-- VOTES TALLY FOR EACH SPECIALIZATION - START --}}
            @foreach($schools as $school)
            @if($school->is_involved)
            <div class="w-2/5">
                <h1 class="text-2xl font-semibold">{{ $school->name }}</h1>
                
                @foreach($specializations as $specialization)
                <div>

                    <div class="mb-3">
                        <h1 class="text-xl">{{ $specialization->name }}</h1>
                        <p>{{ \App\Models\UserSpecialization::all()->where('specialization_id', $specialization->id)->where('has_voted', 1)->count() }} out of   {{ \App\Models\UserSpecialization::all()->where('specialization_id', $specialization->id)->count() }} has voted</p>
                    </div>
                    
                    <table class="w-full rounded-lg shadow-lg mx-1 text-center my-3">
                        
                        <thead>
                            <tr class="bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">Position</th>
                                <th class="px-4 py-3">Candidate</th>
                                <th class="px-4 py-3">Votes</th>
                            </tr>
                        </thead>
                        
                        <tbody class="bg-white">
                            @foreach($positions as $position)
                            <tr>
                                
                                <td class="border">{{ $position->name }}</td>
                                
                                <td class="border">
                                    @foreach($users as $user)
                                    @if($user->candidate != null && $user->userSpecialization->specialization->id == $specialization->id && $user->school->id == $school->id && $user->candidate->position_id == $position->id)
                                    <ul>
                                        <li class="py-1">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name}}</li>
                                    </ul>
                                    @endif
                                    @endforeach
                                </td>
                                
                                <td class="border">
                                    @foreach($users as $user)
                                    @if($user->candidate != null && $user->userSpecialization->specialization->id == $specialization->id && $user->school->id == $school->id  && $user->candidate->position_id == $position->id)
                                    <ul>
                                        <li class="py-1">{{ \App\Models\Vote::where('candidate_id', $user->candidate->id)->count() }}</li>
                                    </ul>
                                    @endif
                                    @endforeach
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
                
                <button type="submit" class="bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500">Get Election Results</button>
                
            </div>

        </form>
            

    </div>
</x-app-layout>