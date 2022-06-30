<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TICaP HUB') }}</title>
    <link rel="icon" class="w-10 h-10" href="{{ url('assets/ticap-logo.png') }}" />

    <!-- Feather Light -->
    <link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Tailwind Elements (Added for the Spinner)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alpine.css') }}">
    {{-- Livewire Styles --}}
    @livewireStyles

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- @foreach ($scripts as $script)
        <script src="{{ $script }}" defer></script>
    @endforeach --}}
    {{-- Alipine.js --}}
    {{-- <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script> --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Feather Light -->
    {{-- <script src="//code.jquery.com/jquery-latest.js" defer></script> --}}
    {{-- <script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8" defer></script> --}}
    <!-- Flowbite Dropdown -->
    {{-- <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js" defer></script> --}}
    {{-- Jquery --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script> --}}
    {{-- Facebook --}}
    {{-- <script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2" defer></script> --}}
</head>

<body>
    <div class="overflow-x-hidden antialiased bg-white text-black">
        {{-- Header --}}
        @include('layouts.navbar')

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Container --}}
        <div class="h-full ml-14 mt-14 mb-10 transition-all duration-300 lg:ml-64">
            <div {{ $attributes->merge(['class' => 'p-5']) }}>
                {{-- Content --}}
                {{ $slot }}
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    @stack('scripts')
    {{-- Livewire Scripts --}}
    @livewireScripts
</body>

</html>
