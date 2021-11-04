<x-guest-layout>
  <link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<section class="container mx-auto">
  {{-- {{ Storage::url($group->groupExhibit->banner_path) }} --}}
  
  {{-- BANNER --}}
  <div class="text-center py-5">
  <h1 class="text-5xl font-semibold">{{ $group->groupExhibit->title }}</h1>
</div>
  <div class="text-gray-600 body-font">
    <div class="container px-5 py-5 mx-auto flex">
      <div class="w-full mx-auto">
        <div class="flex flex-wrap w-full bg-gray-100 py-44 px-20 relative mb-4 shadow-md">
          {{-- @if($group->groupExhibit->video_path == 'assets/sample-video.mp4') --}}
          {{-- <img src="{{ asset(url(assetsvideo_path)) }}" alt=""> --}}
          {{-- @else --}}
          <a href="{{ asset($group->groupExhibit->banner_path) }}" data-featherlight="image">
          <img alt="group photo" class="rounded w-full object-cover h-full object-center block absolute inset-0" src="{{ asset($group->groupExhibit->banner_path) }}">
          </a>
          {{-- @endif --}}
        </div>
      </div>
    </div>
  </div>
  
  
   {{-- PROJECT TITLE AND DESCRIPTION --}}
<div class="container mx-auto w-8/12 bg-white dark:bg-gray-800 rounded shadow-md mt-5">
  <div class="container px-5 py-5 mx-auto">
      <div class="items-center lg:flex">
          <div class="lg:w-1/2">
              <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $group->groupExhibit->title }}</h2>
              <p class="mt-4 text-gray-500 dark:text-gray-400 lg:max-w-md">
                  {{ $group->groupExhibit->description }}
              </p>
          </div>
          <div class="mt-8 lg:mt-0 lg:w-1/2">
              <div class="flex items-center justify-center lg:justify-end">
                  <div class="max-w-lg">
                    <a href="{{ asset($group->groupExhibit->banner_path) }}" data-featherlight="image">
                      <img class="object-cover object-center w-full h-64 rounded-md shadow" src="{{ asset($group->groupExhibit->banner_path) }}" alt="">
                    </a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


  {{-- POSTER AND VID --}}
  <section class="container mx-auto text-gray-600 body-font pt-28">
    <div class="container px-5 mx-auto flex flex-wrap">
      {{-- <div class="lg:w-2/3 mx-auto">
        <div class="flex flex-wrap w-full bg-gray-100 px-10 relative mb-4">
          <iframe class="w-full h-96 object-cover object-center block rounded" src="{{ asset($group->groupExhibit->video_path) }}" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div> --}}
    <div class="container mx-auto text-gray-600 body-font w-8/12">
      <div class="container px-5 mx-auto flex justify-center">
        <div class="flex flex-wrap md:-m-2 -m-1">
          <div class="flex flex-wrap w-1/2">
            <div class="md:p-5 p-1 w-full mx-1 my-3">
              <iframe class="w-full h-full object-cover object-center block rounded" width="875" height="374" src="{{ asset($group->groupExhibit->video_path) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
          <div class="flex flex-wrap w-1/2 cursor-pointer"
          <a href="https://scontent.fcrk1-4.fna.fbcdn.net/v/t1.6435-9/100856189_993765701038697_8447118610056347648_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=730e14&_nc_eui2=AeF6zQ3iDPwDPnjC1HLw5L8Dywp5dygnF47LCnl3KCcXjo9jcRvVPCpbco-amUGilo4L5d6zdcTOc0OSOF2_J-Vw&_nc_ohc=zbedumagr48AX9PruSU&_nc_ht=scontent.fcrk1-4.fna&oh=69e76a3f4b220c219a69131918d72ea9&oe=61854354" data-featherlight="image">
            <div class="md:p-5 p-1 w-full mx-1 my-3">
              <img alt="gallery" class="w-full h-full object-cover object-center block rounded" src="https://scontent.fcrk1-4.fna.fbcdn.net/v/t1.6435-9/100856189_993765701038697_8447118610056347648_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=730e14&_nc_eui2=AeF6zQ3iDPwDPnjC1HLw5L8Dywp5dygnF47LCnl3KCcXjo9jcRvVPCpbco-amUGilo4L5d6zdcTOc0OSOF2_J-Vw&_nc_ohc=zbedumagr48AX9PruSU&_nc_ht=scontent.fcrk1-4.fna&oh=69e76a3f4b220c219a69131918d72ea9&oe=61854354">
            </div>
          </div>
        </a>
        </div>
      </div>
    </div>
  </section>


<div class="text-center my-3">
  @php
    $admin = \App\Models\User::find(1);
    $showExhibit = false;
    if($admin->ticap_id) {
      $ticap = \App\Models\Ticap::find($admin->ticap_id);
      $showExhibit = $ticap->evaluation_finished;
    }
  @endphp
  @if(!$showExhibit)
    <a href="/student-choice-award/{{ $group->id }}" class="md:w-32 bg-red-600 dark:bg-red-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-red-500 dark:hover:bg-red-200 transition ease-in-out duration-300">Vote</a>
  @endif
</div>
</section>

<script src="//code.jquery.com/jquery-latest.js"></script>
  <script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
</x-guest-layout>
