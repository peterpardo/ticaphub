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
    <link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />

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
        <div class="w-1/2">
          <img class="object-cover object-center rounded-lg" alt="hero" src="{{ url('assets/ticaphub.png') }}">
        </div>
      </div>
    </section>

        <section data-aos="fade-up-right" class="container p-6 mx-auto bg-transparent dark:bg-gray-800 mb-10 rounded">
          <h2 class="text-xl font-medium text-gray-800 capitalize dark:text-white md:text-2xl">TICaP Events</h2>

          <div class="flex items-center justify-center">
              <div class="grid gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                <a href="https://scontent.fwnp1-1.fna.fbcdn.net/v/t1.6435-9/87813974_10218551539438340_679660144887332864_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeEM_Zcq7pEvd0tqH70pwZzjYom6lh3I1HxiibqWHcjUfGNq4mJ0vp_gclIduwy0DecNUphu7TNrXwgLzxhmEqKi&_nc_ohc=ddHtGHN63fsAX8EW7qk&_nc_ht=scontent.fwnp1-1.fna&oh=d99009dc6ea5f5cfcb54e1acb5c1ab71&oe=618CC57E" data-featherlight="image">
                  <div class="w-full max-w-xs text-center">
                      <img class="object-cover object-center w-full h-48 mx-auto rounded-lg" src="https://scontent.fwnp1-1.fna.fbcdn.net/v/t1.6435-9/87813974_10218551539438340_679660144887332864_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeEM_Zcq7pEvd0tqH70pwZzjYom6lh3I1HxiibqWHcjUfGNq4mJ0vp_gclIduwy0DecNUphu7TNrXwgLzxhmEqKi&_nc_ohc=ddHtGHN63fsAX8EW7qk&_nc_ht=scontent.fwnp1-1.fna&oh=d99009dc6ea5f5cfcb54e1acb5c1ab71&oe=618CC57E" alt="avatar"/>
                  </div>
                </a>
                <a href="https://scontent.fwnp1-1.fna.fbcdn.net/v/t1.6435-9/66661637_10218896984553709_4667343700752334848_n.jpg?_nc_cat=109&ccb=1-5&_nc_sid=0debeb&_nc_eui2=AeGKYf86bi0eXBGn7dhLwJJgdpCOYcs9y912kI5hyz3L3Xm4syCEIgvyXcdf86Uu7ja_fFLue8453-oQ98jLhV24&_nc_ohc=Dbovdo5UxhgAX8o9FLC&_nc_ht=scontent.fwnp1-1.fna&oh=1e1e10ec78ff01d16ef4057d355dab41&oe=618D71EE" data-featherlight="image">
                  <div class="w-full max-w-xs text-center">
                      <img class="object-cover object-center w-full h-48 mx-auto rounded-lg" src="https://scontent.fwnp1-1.fna.fbcdn.net/v/t1.6435-9/66661637_10218896984553709_4667343700752334848_n.jpg?_nc_cat=109&ccb=1-5&_nc_sid=0debeb&_nc_eui2=AeGKYf86bi0eXBGn7dhLwJJgdpCOYcs9y912kI5hyz3L3Xm4syCEIgvyXcdf86Uu7ja_fFLue8453-oQ98jLhV24&_nc_ohc=Dbovdo5UxhgAX8o9FLC&_nc_ht=scontent.fwnp1-1.fna&oh=1e1e10ec78ff01d16ef4057d355dab41&oe=618D71EE" alt="avatar"/>
                  </div>
                </a>

                <a href="https://scontent.fwnp1-1.fna.fbcdn.net/v/t1.6435-9/84208363_10157998837678232_4444131587499491328_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeHmAILWaduyGUq7VyafWOnHRjfr1E3f8zNGN-vUTd_zM9E5ReZwF5VcWvYY1GqwFUJ490WM3e0k5gubvkM7dEs-&_nc_ohc=stfDLe2TSycAX_TWe34&_nc_ht=scontent.fwnp1-1.fna&oh=ca323163a3dd4c03b32a2a089fa3fcdc&oe=618C8B43" data-featherlight="image">
                  <div class="w-full max-w-xs text-center">
                      <img class="object-cover object-center w-full h-48 mx-auto rounded-lg" src="https://scontent.fwnp1-1.fna.fbcdn.net/v/t1.6435-9/84208363_10157998837678232_4444131587499491328_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeHmAILWaduyGUq7VyafWOnHRjfr1E3f8zNGN-vUTd_zM9E5ReZwF5VcWvYY1GqwFUJ490WM3e0k5gubvkM7dEs-&_nc_ohc=stfDLe2TSycAX_TWe34&_nc_ht=scontent.fwnp1-1.fna&oh=ca323163a3dd4c03b32a2a089fa3fcdc&oe=618C8B43" alt="avatar"/>
                  </div>
                </a>

                <a href="https://scontent.fwnp1-1.fna.fbcdn.net/v/t1.6435-9/87813974_10218551539438340_679660144887332864_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeEM_Zcq7pEvd0tqH70pwZzjYom6lh3I1HxiibqWHcjUfGNq4mJ0vp_gclIduwy0DecNUphu7TNrXwgLzxhmEqKi&_nc_ohc=ddHtGHN63fsAX8EW7qk&_nc_ht=scontent.fwnp1-1.fna&oh=d99009dc6ea5f5cfcb54e1acb5c1ab71&oe=618CC57E" data-featherlight="image">
                  <div class="w-full max-w-xs text-center">
                      <img class="object-cover object-center w-full h-48 mx-auto rounded-lg" src="https://scontent.fwnp1-1.fna.fbcdn.net/v/t1.6435-9/87813974_10218551539438340_679660144887332864_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=8bfeb9&_nc_eui2=AeEM_Zcq7pEvd0tqH70pwZzjYom6lh3I1HxiibqWHcjUfGNq4mJ0vp_gclIduwy0DecNUphu7TNrXwgLzxhmEqKi&_nc_ohc=ddHtGHN63fsAX8EW7qk&_nc_ht=scontent.fwnp1-1.fna&oh=d99009dc6ea5f5cfcb54e1acb5c1ab71&oe=618CC57E" alt="avatar"/>
                  </div>
                </a>
              </div>
          </div>
      </section>

      <section data-aos="fade-down-right" class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
          <img class="lg:w-1/2 md:w-4/6 w-full object-cover object-center rounded" alt="hero" src="{{ url('assets/cyberace.png') }}">
          <div class="text-center lg:w-2/3 w-full">
            <p class="leading-relaxed">Coded by:</p>
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">CYBER ACE</h1>
          </div>
        </div>
      </section>

      <script src="//code.jquery.com/jquery-latest.js"></script>
      <script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
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
