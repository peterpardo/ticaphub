<div>
    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can update the contents of your exhibit that will be seen by other people on the home page of the website.
    </x-info-box>

    {{-- Hero --}}
    <x-title class="mb-2">Hero Image</x-title>
    <div class="flex border-2 justify-center items-center bg-white h-full overflow-hidden" style="max-height: 500px;">
        <img class="w-full object-cover" src="{{ asset('assets/banner.png') }}" alt="ticaphub-group-image">
    </div>
    <div class="text-right mt-2">
        <x-app.button color="blue" wire:click.prevent="$emitTo('group-exhibit.image-form', 'showModal', 'hero')">
            <i class="fa-solid fa-pen mr-1"></i>
            Edit image
        </x-app.button>
    </div>

    <div class="flex flex-col justify-evenly gap-x-5 h-full bg-white py-5 md:flex-row" style="min-height: 24rem;">
        {{-- Poster --}}
        <div class="flex-1">
            <x-title class="mb-2">Poster Image</x-title>
            <div class="grid place-items-center border-2" style="min-height: 620px">
                <div class="w-64 md:w-96 mx-auto">
                    <img class="w-full" src="{{ asset('assets/program-flow-1.jpg') }}" alt="ticaphub-group-poster">
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
        <div class="flex-1">
            <x-title class="mb-2">Project Description</x-title>
            <div class="p-5 border-2 space-y-5" style="min-height: 495px">
                <h1 class="font-semibold text-xl">Project Title</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat omnis nobis minus facere sunt odit sequi quasi ipsa illo! Aspernatur in nihil, unde quam quasi dignissimos incidunt! Beatae tempora consequatur soluta, tempore deleniti explicabo reiciendis eos ipsa neque amet temporibus maiores nostrum. Error saepe consequatur dolorum? Sed neque ratione alias eveniet. Mollitia perferendis rem nam suscipit earum eius harum accusantium, repellendus omnis iusto in voluptatum voluptates beatae ipsum, incidunt dolore quaerat deserunt officia rerum nemo exercitationem cupiditate dolorem! Reiciendis in aspernatur ducimus voluptate laborum quasi culpa quas porro voluptatibus velit, exercitationem illum a sit enim? Alias quae assumenda voluptates libero, magnam iure eius qui cum reprehenderit asperiores facere aspernatur obcaecati voluptatem quod laudantium nemo ducimus. Tempore accusamus alias totam tenetur necessitatibus modi enim quidem architecto aliquam eligendi obcaecati culpa, quis corporis in esse rerum doloremque dolore, distinctio molestiae! Facilis, non perferendis corrupti architecto quam eius molestiae nesciunt dolores aspernatur soluta quibusdam officiis recusandae, vel modi cumque repellendus praesentium reprehenderit natus et? Impedit reiciendis aperiam ipsum sapiente dolorum quidem, beatae eius dolores a quam perspiciatis tenetur distinctio eaque natus! Optio cum neque repellat dicta saepe earum, perferendis temporibus libero! Quis deleniti at officia, magni laudantium corporis porro beatae voluptate quia magnam!</p>
            </div>
            <div class="text-right mt-2">
                <x-app.button color="blue">
                    <i class="fa-solid fa-pen mr-1"></i>
                    Edit description
                </x-app.button>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    {{-- Update Image (Hero and Poster) --}}
    @livewire('group-exhibit.image-form', ['groupExhibit' => $groupExhibit])
</div>
