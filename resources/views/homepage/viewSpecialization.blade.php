<x-guest-layout>
<section class="container mx-auto">


  {{-- PROJECT TITLE AND DESCRIPTION --}}
<div class="container mx-auto w-9/12 bg-white dark:bg-gray-800 rounded shadow-md mt-5">
  <div class="container px-5 py-5 mx-auto">
      <div class="items-center lg:flex">
          <div class="lg:w-1/2">
              <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $group->groupExhibit->title }}</h2>
              <p class="mt-4 text-gray-500 dark:text-gray-400 lg:max-w-md">
                  {{ $group->groupExhibit->description }}
              </p>
          </div>

          <div class="mt-8 lg:mt-0 lg:w-2/3">
              <div class="flex items-center justify-center lg:justify-end">
                  <div class="max-w-lg">
                      <img class="object-cover object-center w-full h-64 rounded-md shadow" src="https://scontent.fwnp1-1.fna.fbcdn.net/v/t1.6435-9/198672820_109054511406402_7566504030318043914_n.png?_nc_cat=105&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeGFcOr9nwyc8yMAVRtHtYodwaMaLf0MDl3Boxot_QwOXZdloawQBlubmJr4LEvHRMICIU3wMaMKCLWhIHshWzPS&_nc_ohc=P7ngvjClQUgAX9jSWfR&_nc_ht=scontent.fwnp1-1.fna&oh=3fd7894ccf079d3ef264af88f37afeae&oe=617B4BAA" alt="">
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

  {{-- BANNER --}}
  <div class="text-gray-600 body-font">
    <div class="container px-5 py-5 mx-auto flex">
      <div class="w-full mx-auto">
        <div class="flex flex-wrap w-full bg-gray-100 py-44 px-20 relative mb-4 shadow-md">
          <img alt="group photo" class="rounded w-full object-cover h-full object-center block absolute inset-0" src="https://dummyimage.com/800x312">
          {{-- {{ Storage::url($group->groupExhibit->banner_path) }} --}}
        </div>
      </div>
    </div>
  </div>

  {{-- POSTER AND VID --}}
<div class="container mx-auto text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto flex flex-wrap">
    <div class="flex flex-wrap md:-m-2 -m-1">
      <div class="flex flex-wrap w-1/2">
        <div class="md:p-5 p-1 w-11/12 bg-white shadow-md rounded-3xl mx-1 my-3">
          <img alt="gallery" class="w-full h-full object-cover object-center block rounded" src="https://dummyimage.com/600x360">
        </div>
      </div>
      <div class="flex flex-wrap w-1/2">
        <div class="md:p-5 p-1 w-11/12 bg-white shadow-md rounded-3xl mx-1 my-3">
          <img alt="gallery" class="w-full h-full object-cover object-center block rounded" src="https://dummyimage.com/600x360">
        </div>
      
      </div>
    </div>
  </div>
</div>


<div class="text-center my-5">
  <button type="submit" class="md:w-32 bg-red-600 dark:bg-red-100 text-white dark:text-white-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-red-500 dark:hover:bg-red-200 transition ease-in-out duration-300">Vote</button>
</div>
</section>

</x-guest-layout>