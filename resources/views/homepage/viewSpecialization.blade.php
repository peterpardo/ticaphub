<x-guest-layout>
  <section class="container mx-auto h-screen">
  
  {{-- PROJECT TITLE AND DESCRIPTION --}}
  @if($group->groupExhibit->title == null)
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
  @endif
  
  {{-- LIVE STREAM --}}
  @if($group->groupExhibit->link == null)
    <div class="text-gray-600 text-center py-5 my-1">Livestream empty</div>
  @else
  <section>
      <div class="container mx-auto text-gray-600 body-font w-1/2 mt-10">
          <video class="w-full h-full object-cover object-center block rounded" controls loop autoplay muted>
              <source src="{{ $group->groupExhibit->link }}" title="Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
          </video>
      </div>
  </section>
  @endif
    {{-- LINK AND POSTER --}}
  <section class="container mx-auto text-gray-600 body-font mt-5">
    <div class="container px-5 mx-auto flex flex-wrap">
    <div class="container mx-auto text-gray-600 body-font w-8/12">
      <div class="container px-5 mx-auto flex justify-center">
        <div class="flex flex-wrap md:m-2 m-1">
          <div class="flex flex-wrap w-1/2">
            <div class="md:p-5 p-1 w-full mx-1 my-3">
              @if($group->groupExhibit->video_path == null)
              <div class="flex justify-center items-center py-20 px-20 w-full">
                  <span>System teaser empty</span>
              </div>
              @else
                @if($group->groupExhibit->video_path == 'assets/sample-video.mp4')
                  <video class="w-full h-full object-cover object-center block rounded" controls loop autoplay muted>
                    <source src="{{ url(asset($group->groupExhibit->video_path)) }}">
                  </video>  
                @else
                  <video class="w-full h-full object-cover object-center block rounded" controls loop autoplay muted>
                    <source src="{{ Storage::url($group->groupExhibit->video_path) }}">
                  </video>  
                @endif
              @endif
            </div>
          </div>
          <div class="flex flex-wrap w-1/2 cursor-pointer">
            <div class="md:p-5 p-1 w-full mx-1 my-3">
              @if($group->groupExhibit->banner_path == null)
                <div class="flex justify-center items-center py-20 px-20 w-full">
                    <span>Banner empty</span>
                </div>
              @else
                @if($group->groupExhibit->banner_path == 'assets/banner.png')
                  <a href="{{ url(asset($group->groupExhibit->banner_path)) }}" data-featherlight="image">
                    <img src="{{ url(asset($group->groupExhibit->banner_path)) }}" class="w-full h-full object-cover object-center block rounded" >
                  </a>
                @else
                  <a href="{{ Storage::url($group->groupExhibit->banner_path) }}" data-featherlight="image">
                    <img src="{{ Storage::url($group->groupExhibit->banner_path) }}" class="w-full h-full object-cover object-center block rounded" >
                  </a>
                @endif
              @endif
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
  </x-guest-layout>
  
  
