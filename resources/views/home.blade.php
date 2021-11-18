@php
	$sliders = DB::table('sliders')->get();
    $streams = DB::table('streams')->get();
    $brands = DB::table('brands')->get();
@endphp
<head>
</head>

<x-guest-layout>
    <body class="overflow-x-auto animate-pulse">
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
</section>
@endif
{{-- MAIN CONTENT --}}
@foreach($streams as $key => $stream)
	<main data-aos="fade-up" class="container mx-auto flex flex-row items-center p-5 w-auto h-screen justify-evenly mt-40 sm:mt-0">
		<div class="grid grid-col md:grid-cols-2">
			<div class="flex flex-row md:justify-start justify-center">
				<div class="flex flex-col w-full md:w-3/4 object-cover h-auto justify-items-start rounded-lg overflow-hidden"
					style="min-heigth:320px">
          <div class="">
            <div class="w-full h-full object-cover object-center block rounded">
                {!! $stream->stream_link !!}
            </div>
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

    <section class="text-gray-600 body-font">
      <div data-aos="fade-down" class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
        <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
          <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">TICaP Hub: An Event Management System for FEU Tech's Technology Innovation on Capstone Projects
            <br class="hidden lg:inline-block">
          </h1>
          <p class="mb-8 leading-relaxed text-justify">
            FEU Tech’s College of Computer Studies hosts an annual event known as Technology Innovation on Capstone Project (TICaP) which exhibits the different capstone projects of each specialization. This event allows the students to view the different projects of the FEU Tech PBL students and recognizes the group with the best capstone project and other special awards. For the event to be successful, an efficient organization and management must be executed.
        </p>
        </div>
        <div class="sm:w-1/2 w-full">
          <img class="object-cover object-center rounded-lg" src="{{ url('assets/ticaphub.png') }}">
        </div>
      </div>
    </section>

        <section data-aos="fade-up-right" class="container p-6 mx-auto bg-transparent dark:bg-gray-800 mb-10 rounded">
            @if($brands->count() == 0)
            <div class="hidden"></div>
            @else
          <h2 class="text-xl font-medium text-gray-800 capitalize dark:text-white md:text-2xl">TICaP Events</h2>

          <div class="flex items-center justify-center">
              <div class="grid gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($brands as $brand)
                <a href="{{ $brand->image }}" data-featherlight="image">
                  <div class="w-full max-w-xs text-center">
                      <img class="object-cover object-center w-full h-48 mx-auto rounded-lg" src="{{ $brand->image }}" alt="avatar"/>
                  </div>
                </a>
                @endforeach
              </div>
          </div>
      </section>
      @endif

      <section data-aos="fade-down-right" class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
          <img class="w-32 h-32  object-cover object-center rounded animate-bounce" alt="hero" src="{{ url('assets/cyberace.png') }}">
          <div class="text-center lg:w-2/3 w-full">
            <p class="leading-relaxed">Coded by:</p>
            <h1 class="title-font sm:text-2xl text-3xl mb-4 font-medium text-gray-900">CYBER ACE</h1>
          </div>
        </div>
      </section>

      <script src="//code.jquery.com/jquery-latest.js"></script>
      <script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    </body>
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
