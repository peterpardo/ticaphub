<x-guest-layout>
    <div class="container mx-auto p-5 space-y-3">
        <x-app.button type="link" color="gray" href="{{ route('schools') }}">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Go back
        </x-app.button>

        <h1 class="text-xl my-5 font-bold">{{ $specialization->school->name . ' | ' . $specialization->name }}</h1>

        <div class="grid grid-cols-1 gap-y-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($groups as $group)
                <a href="{{ url('group/' . $group->id) }}" class="block">
                    <div class="bg-white shadow-md rounded-lg mx-1 my-3 cursor-pointer overflow-hidden">
                        <div class="overflow-hidden relative">
                            <img class="h-52 hover:opacity-75 w-full object-cover" src="{{url('/assets/specialization.png')}}">
                        </div>
                        <div class="h-24 min-h-full p-5 grid place-items-center text-center">
                            <h1 class="text-xl font-semibold text-gray-800">{{ $group->name }}</h1>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
  </x-guest-layout>
