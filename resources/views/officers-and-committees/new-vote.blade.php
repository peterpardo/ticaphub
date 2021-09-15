<x-app-layout>
    <x-page-title>
        {{ $title }}
    </x-page-title>

    <div class="flex flex-col justify-center">

        <h1 class="font-bold text-6xl mb-2 text-center">{{ $ticap }}</h1>

        <h1 class="text-center text-4xl mb-3">Election of Officers</h1>

        <form 
            action="{{ route('vote') }}" 
            method="post"
            class="mx-auto flex flex-col justify-center">
            @csrf

            @if ($errors->any())
            <div class="text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <div class="text-center mb-5">
                <h1 class="text-3xl font-bold">{{ $school->name }}</h1>
                <h1 class="text-xl">{{ $specialization->name }}</h1>
                <h1 class="text-xl font-bold">Re-election</h1>
            </div>

            @foreach($positions as $position) 
            <div class="mb-3">

                <div class="font-semibold text-xl border-b-2 border-gray-500 px-3 mb-2">{{ $position->name }}</div>

                <ul>
                    @foreach($officers as $officer)
                        @if(
                            $officer->candidate->user->userProgram->specialization->id == $specialization->id &&
                            $officer->candidate->position->id == $position->id &&
                            $officer->candidate->school->id == $school->id
                        )
                            @if($officer->is_elected)
                                <li>
                                    {{ $officer->candidate->user->first_name . ' ' .  $officer->candidate->user->middle_name . ' ' . $officer->candidate->user->last_name }} - <span class="text-green-500">wait for results</span>
                                </li>
                            @else
                            <li>
                                <input type="radio" name="{{ $position->name }}" id="{{ $officer->candidate->user->id }}" value="{{ $officer->candidate->id }}">
                                <label for="{{ $officer->candidate->user->id   }}">{{ $officer->candidate->user->first_name . ' ' .  $officer->candidate->user->middle_name . ' ' . $officer->candidate->user->last_name }}</label>
                            </li>
                            @endif 
                        @endif
                    @endforeach
                </ul>

            </div>
            @endforeach
            
            <div class="text-center">

                <button type="submit" class="bg-green-600 py-2 px-5 rounded mr-1 text-white hover:bg-green-500">Send Vote</button>
    
            </div>

        </form>
       
    </div>
</x-app-layout>