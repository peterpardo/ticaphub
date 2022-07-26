<x-guest-layout>
    <section>

        {{-- PROJECT TITLE AND DESCRIPTION --}}
        {{-- @if($group->groupExhibit->title == null)
            <div class="text-gray-600 text-center py-5 my-1">Exhibit empty</div>
        @else
            <div class="container mx-auto w-8/12 bg-white rounded shadow-md mt-5">
                <div class="container px-5 py-5 mx-auto">
                    <div class="items-center">
                        <div class="">
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $group->groupExhibit->title }}</h2>
                            <p class="mt-4 text-gray-500 dark:text-gray-400">
                                {{ $group->groupExhibit->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}

        {{-- Hero --}}
        <div class="flex justify-center items-center bg-white h-full overflow-hidden" style="height: 500px;">
            <img class="w-full object-cover" src="{{ asset('assets/banner.png') }}" alt="ticaphub-group-image">
        </div>

        {{-- Group name --}}
        <div class="flex flex-col items-center py-10 h-96">
            <div class="flex items-center justify-center w-52 h-36 overflow-hidden">
                <img class="w-full" src="{{ asset('assets/cyberace.png') }}" alt="ticaphub-group-logo">
            </div>
            <h1 class="font-bold text-5xl md:text-7xl text-center mt-5">CYBER ACE</h1>
        </div>

        {{-- Poster and Description --}}
        <div class="flex flex-col justify-evenly gap-y-5 items-center h-full bg-white py-5 md:flex-row" style="min-height: 24rem;">
            <div class="border-2 w-80">
                <img class="w-full" src="{{ asset('assets/program-flow-1.jpg') }}" alt="ticaphub-group-poster">
            </div>
            <div class="px-5 md:w-96 space-y-5">
                <h1 class="font-semibold text-xl">Project Title</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis alias itaque doloremque autem sapiente, rem quod facere cupiditate iusto praesentium consectetur porro repellat minus accusantium molestias quo corrupti perspiciatis esse optio earum! Eaque explicabo fugiat maxime quas unde qui sunt vitae voluptas velit necessitatibus totam nobis eum sequi molestias saepe, in laborum minima libero consectetur deserunt architecto similique voluptatibus hic. Architecto dicta repudiandae ut, a, provident quibusdam saepe quas nemo nulla vero illum tenetur quos. Suscipit omnis optio aut sunt eos at alias ad, quasi eius animi illo incidunt, cum quo fuga ipsam officia tenetur, quibusdam ea fugiat aspernatur! Sequi.</p>
            </div>
        </div>

        {{-- Group members --}}
        <div class="flex flex-col items-center py-10 h-96">
            <h1 class="font-bold text-xl text-center">Team CYBER ACE</h1>
            <div class="flex items-center justify-between mt-10 gap-x-10">
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
        <div class="h-96 bg-red-800"></div>

    </section>
</x-guest-layout>


