<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ url('assets/ticap-logo.png') }}"/>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/homeburgermenu.js') }}" defer></script>
    </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous" />
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700;900&display=swap" rel="stylesheet">
<style>
  html,
body {
  font-family: "Rubik", sans-serif;
}

/* navigation 
 - show navigation always on the large screen devices with (min-width:1024)
*/

@media (min-width: 1024px) {
  .top-navbar {
    display: inline-flex !important;
  }
}
</style>

<nav class="flex items-center bg-red-800 p-3 flex-wrap">
      <a href="{{ route ('home') }}" class="p-2 mr-4 inline-flex items-center">
        <img class="w-7 h-7" src="{{ url('assets/ticap-logo.png') }}" alt="">
        <span  class="text-xl text-white font-bold uppercase tracking-wide"
          >TICaP HUB</span>
      </a>
      <button
        class="text-white inline-flex p-3 hover:bg-white-900 rounded lg:hidden ml-auto hover:text-white outline-none nav-toggler"
        data-target="#navigation">
        <i class="material-icons">menu</i>
      </button>
      <div
        class="hidden top-navbar w-full lg:inline-flex lg:flex-grow lg:w-auto"
        id="navigation">
        <div
          class="lg:inline-flex lg:flex-row lg:ml-auto lg:w-auto w-full lg:items-center items-start  flex flex-col lg:h-auto">
          <a
            href="{{ route ('home') }}"
            class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-red-900 hover:text-white">
            <span>Home</span>
          </a>
          {{-- CHECK IF TICAP EXISTS --}}
          @php
              $admin = \App\Models\User::find(1);
              $showExhibit = false;
              if($admin->ticap_id) {
                $ticap = \App\Models\Ticap::find($admin->ticap_id);
                $showExhibit = $ticap->awards_is_set;
              }
          @endphp
          @if($showExhibit)
            <a
            href="{{ route ('schools') }}"
              class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-red-900 hover:text-white">
              <span>Project Exhibit</span>
            </a>
          @endif
          <a
          href="{{ route('about-ticap') }}"
          class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-red-900 hover:text-white">
          <span>About Us</span>
        </a>
		  @auth
		  <a class="lg:inline-flex md:ml-5 bg-red-700 lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-red-400 hover:text-white" href="{{ route('dashboard') }}">Go to Dashboard</a>
	  @else
		  <a class="lg:inline-flex md:ml-5 bg-red-700 lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-red-400 hover:text-white" href="{{ route('login') }}">Sign in</a>
	  @endauth
        </div>
      </div>
    </nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
  $(".nav-toggler").each(function(_, navToggler) {
    var target = $(navToggler).data("target");
    $(navToggler).on("click", function() {
      $(target).animate({
        height: "toggle"
      });
    });
  });
});
</script>
    <body class="bg-gray-100">
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
