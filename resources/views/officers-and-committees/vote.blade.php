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
                <h1 class="text-3xl font-bold">{{ $userSchool }}</h1>
                <h1 class="text-xl">{{ $userSpecialization }}</h1>
            </div>

            @foreach($positions as $position) 
            <div class="mb-3">

                <div class="font-semibold text-xl border-b-2 border-gray-500 px-3 mb-2">{{ $position->name }}</div>

                <ul class="mb-2">
                    @foreach($users as $user) 
                    @if($user->candidate != null && 
                    Auth::user()->userProgram->school->id == $user->userProgram->school->id &&
                    $user->candidate->position_id == $position->id && 
                    Auth::user()->userProgram->specialization_id == $user->candidate->specialization_id)
                    <li>
                        <input type="radio" name="{{ $position->name }}" id="{{ $user->id }}" value="{{ $user->candidate->id }}">
                        <label for="{{ $user->id  }}">{{ $user->last_name . ', ' .  $user->first_name . ' ' . $user->middle_name }}</label>
                    </li>
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