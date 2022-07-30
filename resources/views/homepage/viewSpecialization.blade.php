<x-guest-layout>
    <section>
        {{-- Hero --}}
        <div class="hidden md:flex justify-center items-center bg-black overflow-hidden relative" style="height: 655px;">
            <div class="absolute inset w-full text-center text-white text-3xl z-10 italic tracking-wider" style="max-width: 80rem">"{{ $groupExhibit->title }}"</div>
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
                <div class="flex items-center justify-center w-60 h-36 overflow-hidden -mt-14">
                    <img class="w-full" src="{{ asset($groupExhibit->logo) }}" alt="ticaphub-group-logo">
                </div>
            @endif
            <h1 class="font-bold text-5xl md:text-7xl text-center">CYBER ACE</h1>
        </div>

        {{-- Poster and Description --}}
        {{-- <div class="flex flex-col justify-evenly gap-y-5 items-center h-full bg-white py-5 md:flex-row" style="min-height: 24rem;"> --}}
        <div class="grid grid-cols-1  gap-y-5 h-full bg-white py-5 md:grid-cols-2" style="min-height: 24rem;">
            <div class="grid place-items-center mx-auto border-2 w-80">
                <img class="w-full" src="{{ asset('assets/program-flow-1.jpg') }}" alt="ticaphub-group-poster">
            </div>
            <div class="px-5 md:w-96 space-y-5 mx-auto">
                <h1 class="font-semibold text-xl">Project Title</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe omnis, reprehenderit quod labore quam a voluptatem, iusto possimus illum quaerat neque odit! Ratione at nemo consectetur voluptates similique quae minima, a magni accusamus eius repellat suscipit aperiam sapiente natus deserunt perferendis earum commodi exercitationem velit cum iste placeat distinctio. Doloremque animi omnis doloribus odio nulla voluptatem, veniam non alias voluptate at, sed, reprehenderit commodi nostrum repellendus. Perferendis maxime cum fugiat, esse eligendi quos neque mollitia provident at cumque vitae atque temporibus porro quibusdam inventore necessitatibus officia ipsam corrupti, perspiciatis aperiam. Dolores consectetur quis atque beatae architecto exercitationem aut eum accusamus.</p>
            </div>
        </div>

        {{-- Group members --}}
        <div class="flex flex-col items-center py-10 h-full" style="min-height: 24rem;">
            <h1 class="font-bold text-xl text-center">Team CYBER ACE</h1>
            <div class="flex flex-col gap-y-5 items-center justify-between mt-10 md:flex-row md:gap-x-10">
                <div class="flex flex-col justify-center items-center gap-y-2">
                    <div class="w-36 h-36 overflow-hidden rounded-full">
                        <img class="w-full" src="{{ asset('assets/mina.jpg') }}" alt="ticaphub-group-member">
                    </div>
                    <h2 class="font-semibold text-lg">Myoui Mina</h2>
                    <span class="text-gray-500">Project Manager</span>
                </div>
                <div class="flex flex-col justify-center items-center gap-y-2">
                    <div class="w-36 h-36 overflow-hidden rounded-full">
                        <img class="w-full" src="{{ asset('assets/mina.jpg') }}" alt="ticaphub-group-member">
                    </div>
                    <h2 class="font-semibold text-lg">Myoui Mina</h2>
                    <span class="text-gray-500">Project Manager</span>
                </div>
                <div class="flex flex-col justify-center items-center gap-y-2">
                    <div class="w-36 h-36 overflow-hidden rounded-full">
                        <img class="w-full" src="{{ asset('assets/mina.jpg') }}" alt="ticaphub-group-member">
                    </div>
                    <h2 class="font-semibold text-lg">Myoui Mina</h2>
                    <span class="text-gray-500">Project Manager</span>
                </div>
                <div class="flex flex-col justify-center items-center gap-y-2">
                    <div class="w-36 h-36 overflow-hidden rounded-full">
                        <img class="w-full" src="{{ asset('assets/mina.jpg') }}" alt="ticaphub-group-member">
                    </div>
                    <h2 class="font-semibold text-lg">Myoui Mina</h2>
                    <span class="text-gray-500">Project Manager</span>
                </div>
                <div class="flex flex-col justify-center items-center gap-y-2">
                    <div class="w-36 h-36 overflow-hidden rounded-full">
                        <img class="w-full" src="{{ asset('assets/mina.jpg') }}" alt="ticaphub-group-member">
                    </div>
                    <h2 class="font-semibold text-lg">Myoui Mina</h2>
                    <span class="text-gray-500">Project Manager</span>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="text-white h-96 bg-red-800 p-10">
            <h1>Follow us on</h1>
            <div class="flex items-center gap-x-5 mt-5">
                <span>
                    <a href="https://www.facebook.com" target="_blank" class="text-4xl"><i class="fa-brands fa-facebook"></i></a>
                </span>
                <span>
                    <a href="https://www.twitter.com" target="_blank" class="text-4xl"><i class="fa-brands fa-twitter"></i></a>
                </span>
                <span>
                    <a href="https://www.instagram.com" target="_blank" class="text-4xl"><i class="fa-brands fa-instagram"></i></a>
                </span>
                <span>
                    <a href="https://www.youtube.com" target="_blank" class="text-4xl"><i class="fa-brands fa-youtube"></i></a>
                </span>
            </div>
        </div>

    </section>
</x-guest-layout>


