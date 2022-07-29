<div>
    <h1 class="font-bold text-2xl mb-4"><span class="text-gray-500 font-semibold">Group name:</span> {{ $groupExhibit->group->name }}</h1>

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can update the contents of your exhibit that will be seen by other people on the home page of the website.
    </x-info-box>

    {{-- Hero --}}
    <x-title class="mb-2">Hero Image</x-title>
    <div class="flex border-2 justify-center items-center bg-white h-full overflow-hidden" style="max-height: 500px;">
        @if (!is_null($groupExhibit->hero_image))
            <img class="w-full object-cover" src="{{ asset($groupExhibit->hero_image) }}" alt="ticaphub-group-image">
        @else
            <img class="opacity-10" src="https://media.istockphoto.com/vectors/photo-coming-soon-image-icon-vector-illustration-isolated-on-white-vector-id1193046541?k=6&m=1193046541&s=612x612&w=0&h=1p8PD2GfCfIOPx0UTPXW3UDWpoJ4D0yJVJJzdqMDdsY=" alt="ticaphub-group-image">
        @endif
    </div>
    <div class="text-right mt-2">
        <x-app.button color="blue" wire:click.prevent="$emitTo('group-exhibit.image-form', 'showModal', 'hero')">
            <i class="fa-solid fa-pen mr-1"></i>
            Edit image
        </x-app.button>
    </div>

    {{-- <div class="flex flex-col justify-evenly gap-x-5 h-full bg-white py-5 md:flex-row" style="min-height: 24rem;"> --}}
    <div class="grid grid-cols-1 gap-x-5 gap-y-5 md:grid-cols-2">
        {{-- Logo --}}
        <div>
            <x-title class="mb-2">Group Logo</x-title>
            <div class="grid place-items-center border-2" style="min-height: 510px">
                <div class="w-full" style="max-width: 400px">
                    @if (!is_null($groupExhibit->logo))
                        <img class="w-full" src="{{ asset($groupExhibit->logo) }}" alt="ticaphub-group-poster">
                    @else
                        <img class="opacity-10" src="https://media.istockphoto.com/vectors/photo-coming-soon-image-icon-vector-illustration-isolated-on-white-vector-id1193046541?k=6&m=1193046541&s=612x612&w=0&h=1p8PD2GfCfIOPx0UTPXW3UDWpoJ4D0yJVJJzdqMDdsY=" alt="ticaphub-group-poster">
                    @endif
                </div>
            </div>
            <div class="text-right mt-2">
                <x-app.button color="blue" wire:click.prevent="$emitTo('group-exhibit.image-form', 'showModal', 'logo')">
                    <i class="fa-solid fa-pen mr-1"></i>
                    Edit logo
                </x-app.button>
            </div>
        </div>

        {{-- Poster --}}
        <div>
            <x-title class="mb-2">Poster Image</x-title>
            <div class="grid place-items-center border-2" style="min-height: 510px">
                <div class="w-full" style="max-width: 350px">
                    @if (!is_null($groupExhibit->poster_image))
                        <img class="w-full" src="{{ asset($groupExhibit->poster_image) }}" alt="ticaphub-group-poster">
                    @else
                        <img class="opacity-10" src="https://media.istockphoto.com/vectors/photo-coming-soon-image-icon-vector-illustration-isolated-on-white-vector-id1193046541?k=6&m=1193046541&s=612x612&w=0&h=1p8PD2GfCfIOPx0UTPXW3UDWpoJ4D0yJVJJzdqMDdsY=" alt="ticaphub-group-poster">
                    @endif
                </div>
            </div>
            <div class="text-right mt-2">
                <x-app.button color="blue" wire:click.prevent="$emitTo('group-exhibit.image-form', 'showModal', 'poster')">
                    <i class="fa-solid fa-pen mr-1"></i>
                    Edit poster
                </x-app.button>
            </div>
        </div>

        {{-- Description --}}
        <div>
            <x-title class="mb-2">Project Description</x-title>
            <div class="p-5 border-2 space-y-5" style="min-height: 510px">
                {{-- Title --}}
                @if (is_null($groupExhibit->title))
                    <h1 class="font-semibold text-gray-300 text-xl">Project title here...</h1>
                @else
                    <h1 class="font-semibold text-xl">{{ $groupExhibit->title }}</h1>
                @endif

                {{-- Description --}}
                @if (is_null($groupExhibit->description))
                    <p class="text-gray-300">Project description here...</p>
                @else
                    <p>{{ $groupExhibit->description }}</p>
                @endif
            </div>
            <div class="text-right mt-2">
                <x-app.button color="blue" wire:click.prevent="$emitTo('group-exhibit.description-form', 'showModal')">
                    <i class="fa-solid fa-pen mr-1"></i>
                    Edit description
                </x-app.button>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    {{-- Update Image (Hero and Poster) --}}
    @livewire('group-exhibit.image-form', ['groupExhibit' => $groupExhibit])

    {{-- Update Project description --}}
    @livewire('group-exhibit.description-form', ['groupExhibit' => $groupExhibit])
</div>
