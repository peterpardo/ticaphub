<x-guest-layout>
    <div class="container mx-auto p-5 space-y-3">
        <x-app.button type="link" color="gray" href="{{ route('schools') }}">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Go back
        </x-app.button>

        <h1 class="text-xl my-5 font-bold">{{ $specialization->school->name . ' | ' . $specialization->name }}</h1>

        @if($groups->count() == 0)
            <div class="text-center p-10 h-96">No groups exists</div>
        @else
            <div class="grid grid-cols-1 gap-y-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($groups as $group)
                    <a href="{{ url('groups/' . $group->id) }}" class="block">
                        <div class="bg-white shadow-md rounded-lg mx-1 my-3 cursor-pointer overflow-hidden">
                            <div class="overflow-hidden relative border hover:opacity-80">
                                @if ($group->groupExhibit->hero_image)
                                    <img class="h-52 w-full object-cover" src="{{ asset($group->groupExhibit->hero_image) }}">
                                @else
                                    <img class="h-52 object-cover mx-auto opacity-30 " src="https://media.istockphoto.com/vectors/photo-coming-soon-image-icon-vector-illustration-isolated-on-white-vector-id1193046541?k=6&m=1193046541&s=612x612&w=0&h=1p8PD2GfCfIOPx0UTPXW3UDWpoJ4D0yJVJJzdqMDdsY=">
                                @endif
                            </div>
                            <div class="h-24 min-h-full p-5 grid place-items-center text-center">
                                <h1 class="text-xl font-semibold text-gray-800">{{ $group->name }}</h1>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
  </x-guest-layout>
