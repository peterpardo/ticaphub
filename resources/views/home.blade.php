@php
	$sliders = DB::table('sliders')->get();
    $streams = DB::table('streams')->get();
@endphp
<head>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<x-guest-layout>
    @if($sliders->count() == 0)
    <div class="hidden"></div>
    @else
<section>
    <div class="w-full mx-auto overflow-hidden">
        <div id="slider" class="swiper-container w-full mx-auto">
            <div class="swiper-wrapper">
                @foreach($sliders as $key => $slider)
                <div class="swiper-slide bg-cover bg-center h-full text-white py-24 px-10 object-fill" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{asset($slider->image)}}); background-repeat: no-repeat; background-size: cover;">
                    <div class="container mx-auto px-6 md:px-20 py-6">
                        <div class="w-full md:w-1/2">
                            <div class="mt-24">
                                <h3 class="text-5xl font-bold">{{ $slider->title }}</h3>
                                <p class="text-2xl pt-10 leading-none">{{ $slider->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="hidden md:flex swiper-button-prev bg-transparent w-10 h-w-10 text-xs rounded-full text-red-600"></div>
            <div class="hidden md:flex swiper-button-next bg-transparent w-10 h-w-10 text-xs rounded-full text-red-600"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endif
{{-- MAIN CONTENT --}}
@foreach($streams as $key => $stream)
	<main class="container mx-auto flex flex-row items-center p-5 w-auto h-screen justify-evenly mt-40 sm:mt-0">
		<div class="grid grid-col md:grid-cols-2">
			<div class="flex flex-row md:justify-start justify-center">
				<div class="flex flex-col w-full md:w-3/4 object-cover h-auto justify-items-start rounded-lg overflow-hidden"
					style="min-heigth:320px">
					<div class="h-72 w-full">
                        <iframe class="w-full h-full object-cover object-center block rounded" src="{{ $stream->stream_link }}" width="1080" height="1920" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
					</div>
				</div>

				</div>

				<div class="flex flex-row items-center">
					<div class="flex flex-col">
						<h1 class="capitalize text-4xl font-extrabold mb-3">{{ $stream->title }}</h1>
						<p class="w-auto text-lg text-gray-500 text-justify">{{ $stream->description }}</p>
						<div class="flex items-center my-6 cursor-pointer">
						</div>
					</div>
				</div>


			</div>
	</main>
    @endforeach
</x-guest-layout>
<style>
    .swiper-pagination-bullet-active {
  background-color: rgba(220, 38, 38, var(--tw-text-opacity));
}
</style>
<script>
    var mySwiper = new Swiper ('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        autoplay: {
            delay: 4000,
        },
        loop: true,
    });
</script>
