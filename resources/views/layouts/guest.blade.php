<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ url('assets/ticap-logo.png') }}"/>


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous" defer></script> --}}

    <!-- Feather Light Scripts -->
    <script src="//code.jquery.com/jquery-latest.js"></script>
    {{-- <script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script> --}}

    {{-- SWIPER --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    {{-- Custom CSS --}}
    <style>
        html,
        body {
            font-family: "Rubik", sans-serif;
        }

        .swiper-pagination-bullet-active {
            background-color: rgba(220, 38, 38, var(--tw-text-opacity));
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
</head>

<body class="bg-gray-100">
    {{-- Navbar --}}
    <nav class="flex items-center bg-red-800 p-3 flex-wrap">
        <a href="{{ route ('home') }}" class="p-2 mr-4 inline-flex items-center">
            <img class="w-7 h-7" src="{{ url('assets/ticap-logo.png') }}" alt="">
            <span  class="text-xl text-white font-bold uppercase tracking-wide"
            >TICAPHUB</span>
        </a>

        <button class="text-white inline-flex p-3 hover:bg-white-900 rounded lg:hidden ml-auto hover:text-white outline-none nav-toggler" data-target="#navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="hidden top-navbar w-full lg:inline-flex lg:flex-grow lg:w-auto" id="navigation">
            <div class="lg:inline-flex lg:flex-row lg:ml-auto lg:w-auto w-full lg:items-center items-start  flex flex-col lg:h-auto">
                <a href="{{ route ('home') }}" class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-red-900 hover:text-white">
                    <span>Home</span>
                </a>

                <a href="{{ route ('schools') }}" class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-red-900 hover:text-white">
                    <span>Capstone Projects</span>
                </a>

                @auth
                    <a class="lg:inline-flex md:ml-5 bg-red-700 lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-red-400 hover:text-white" href="{{ route('dashboard') }}">Go to Dashboard</a>
                @else
                    <a class="lg:inline-flex md:ml-5 bg-red-700 lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-red-400 hover:text-white" href="{{ route('login') }}">Sign in</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    {{-- Scripts --}}
    @stack('scripts')
    <script>
        $(document).ready(function() {
            $(".nav-toggler").each(function(_, navToggler) {
                const target = $(navToggler).data("target");

                $(navToggler).on("click", function() {
                    $(target).animate({
                        height: "toggle"
                    });
                });
            });
        });
    </script>
    <script>AOS.init();</script>
</body>

</html>
