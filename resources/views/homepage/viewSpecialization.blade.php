<x-guest-layout>
    <section>
        {{-- Hero --}}
        <div class="hidden md:flex justify-center items-center bg-black overflow-hidden relative" style="height: 655px;">
            @if (!is_null($groupExhibit->title))
                <div class="absolute inset w-full text-center text-white text-3xl z-10 italic tracking-wider" style="max-width: 80rem">"{{ $groupExhibit->title }}"</div>
            @endif
            @if (!is_null($groupExhibit->hero_image))
                <img class="opacity-40 w-full object-cover" src="{{ asset($groupExhibit->hero_image) }}" alt="ticaphub-group-image">
            @else
                <img class="opacity-10" src="https://media.istockphoto.com/vectors/photo-coming-soon-image-icon-vector-illustration-isolated-on-white-vector-id1193046541?k=6&m=1193046541&s=612x612&w=0&h=1p8PD2GfCfIOPx0UTPXW3UDWpoJ4D0yJVJJzdqMDdsY=" alt="ticaphub-group-image">
            @endif|
        </div>

        {{-- Group name --}}
        <div class="flex flex-col justify-center items-center py-10 h-96">
            {{-- Logo --}}
            @if (!is_null($groupExhibit->logo))
                <div class="flex items-center justify-center w-48 h-48 overflow-hidden rounded-full -mt-14">
                    <img class="w-full" src="{{ asset($groupExhibit->logo) }}" alt="ticaphub-group-logo">
                </div>
            @endif
            <h1 class="font-bold text-5xl md:text-7xl text-center -mt-1">{{ $groupExhibit->group->name }}</h1>
        </div>

        {{-- Poster and Description --}}
        <div class="grid grid-cols-1  gap-y-5 h-full bg-white py-5 md:grid-cols-2" style="min-height: 24rem;">
            <div class="grid place-items-center mx-auto border-2 w-80" style="min-height: 500px">
                @if (!is_null($groupExhibit->poster_image))
                    <img class="w-full" src="{{ asset($groupExhibit->poster_image) }}" alt="ticaphub-group-poster">
                @else
                    <img class="w-full opacity-10" src="https://media.istockphoto.com/vectors/photo-coming-soon-image-icon-vector-illustration-isolated-on-white-vector-id1193046541?k=6&m=1193046541&s=612x612&w=0&h=1p8PD2GfCfIOPx0UTPXW3UDWpoJ4D0yJVJJzdqMDdsY=" alt="ticaphub-poster-image">
                @endif
            </div>
            <div class="px-5 md:w-96 space-y-5 mx-auto">
                <h1 class="font-semibold text-xl">{{ $groupExhibit->title }}</h1>
                <p>{{ $groupExhibit->description }}</p>
            </div>
        </div>

        {{-- Group members --}}
        <div class="flex flex-col items-center py-10 px-5 h-full" style="min-height: 24rem;">
            <h1 class="font-bold text-3xl text-center">Team {{ $groupExhibit->group->name }}</h1>
            {{-- <div class="flex flex-wrap gap-5 items-center justify-center mt-10"> --}}
            <div class="flex flex-wrap gap-5 items-center justify-center mt-10 w-full">
                @foreach ($members as $member)
                    <div class="flex flex-col justify-center items-center gap-y-2 w-full p-5" style="max-width: 250px">
                        <div class="w-36 h-36 overflow-hidden rounded-full">
                            @if ($member->user->profile_picture)
                                <img class="w-full" src="{{ asset($member->user->profile_picture) }}" alt="ticaphub-group-member">
                            @else
                                <img class="w-full" src="{{ asset('assets/default-img.png') }}" alt="ticaphub-group-member">
                            @endif
                        </div>
                        <h2 class="font-semibold text-lg text-center">{{ $member->user->first_name }} {{ $member->user->last_name }}</h2>
                        {{-- <span class="text-gray-500">Project Manager</span> --}}
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Footer --}}
        <div class="text-white h-96 bg-red-800 p-10">
            <h1>Follow us on</h1>
            <div class="flex items-center gap-x-5 mt-5">
                <span>
                    <a href="{{ $groupExhibit->facebook_link }}" target="_blank" class="text-4xl"><i class="fa-brands fa-facebook"></i></a>
                </span>
                <span>
                    <a href="{{ $groupExhibit->youtube_link }}" target="_blank" class="text-4xl"><i class="fa-brands fa-youtube"></i></a>
                </span>
                <span>
                    <a href="{{ $groupExhibit->instagram_link }}" target="_blank" class="text-4xl"><i class="fa-brands fa-instagram"></i></a>
                </span>
                <span>
                    <a href="{{ $groupExhibit->twitter_link }}" target="_blank" class="text-4xl"><i class="fa-brands fa-twitter"></i></a>
                </span>
            </div>
        </div>

    </section>
</x-guest-layout>


