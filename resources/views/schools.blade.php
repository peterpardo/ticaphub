<x-guest-layout>
    <div class="container mx-auto p-5">
        <div class="mt-5 mb-5">
            <ul class="flex gap-x-4 ">
                @foreach ($schools as $school)
                    <li class="font-semibold @if($isActive == $school->id) border-b-2 border-red-700 @endif">
                        <a href="{{ route('schools', ['id' => $school->id]) }}">{{ $school->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <h1 class="text-xl my-5 font-bold">Specializations</h1>

        {{-- Specializations --}}
        <div class="grid grid-cols-1 gap-y-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($specializations as $specialization)
                <a href="{{ url('specializations/' . $specialization->id) }}" class="block bg-white shadow-md rounded-lg mx-1 my-3 cursor-pointer ">
                    <div class="rounded-lg overflow-hidden">
                        <img class="h-52 hover:opacity-75 w-full object-cover" src="{{url('/assets/specialization.png')}}">
                    </div>
                    <div class="p-5 text-center text-xl font-semibold text-gray-800 overflow-ellipsis overflow-hidden">
                        {{ $specialization->name }}
                    </div>
                </a>
            @endforeach
        </div>
  </div>
</x-guest-layout>
