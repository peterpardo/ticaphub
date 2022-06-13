<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TICaP HUB') }}</title>
    <link rel="icon" class="w-10 h-10" href="{{ url('assets/ticap-logo.png') }}" />

    <!-- Feather Light -->
    <link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css"
        rel="stylesheet" />

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Tailwind Elements (Added for the Spinner)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Livewire Styles --}}
    @livewireStyles
</head>

<body>
    <div x-data="setup()" :class="">
        <div
            class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">
            <!-- Header -->
            <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
                {{-- Profile Picture and Name --}}
                <div
                    class="flex items-center justify-start md:justify-between pl-1 w-14 md:w-64 h-14 bg-red-800 dark:bg-gray-800 border-none">
                    <div class="flex justify-between items-center">
                        <div class="flex justify-between items-center mr-2">
                            @if (Auth::user()->profile_picture)
                                <img class="w-12 h-12 rounded-full"
                                    src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="" loading="lazy" />
                            @else
                                <img class="w-12 h-12 rounded-full" src="{{ url(asset('assets/default-img.png')) }}"
                                    alt="" loading="lazy" />
                            @endif
                        </div>
                        <span class="hidden md:inline-block">Hello, {{ Auth::user()->first_name }}!</span>
                    </div>
                </div>

                <div class="flex justify-between items-center h-14 bg-red-800 dark:bg-gray-800 header-right">
                    {{-- Space between Profile Picture and Dropdown Menu --}}
                    <div class="flex items-center w-full max-w-xl mr-4 p-2 "></div>

                    <ul class="flex items-center">
                        {{-- Dropdown Menu --}}
                        <div class="dropdown inline-block relative">
                            <button class="text-white font-semibold py-3 px-9 rounded inline-flex items-center">
                                <span>Menu</span>
                            </button>

                            <ul class="dropdown-content absolute hidden text-white text-sm text-left pt-1">
                                <li>
                                    <a class="bg-red-800 hover:bg-red-600 py-2 px-10 block whitespace-no-wrap dark:bg-gray-800 dark:hover:bg-gray-600"
                                        href="{{ route('profile.update') }}">
                                        Manage Profile
                                    </a>
                                </li>

                                {{-- Logout Button --}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="rounded-b z-50 bg-red-800 hover:bg-red-600 py-2 px-10 block whitespace-no-wrap dark:bg-gray-800 dark:hover:bg-gray-600"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
            {{-- Header --}}

            {{-- Sidebar --}}
            @include('layouts.sidebar')

            {{-- Main Page Content --}}
            <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
                <div class="flex-1 px-4 py-2">
                    {{ $slot }}
                </div>
            </div>

            {{-- Scripts --}}
            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
            <script>
                const setup = () => {
                    const getTheme = () => {
                        if (window.localStorage.getItem('dark')) {
                            return JSON.parse(window.localStorage.getItem('dark'))
                        }
                        return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
                    }

                    const setTheme = (value) => {
                        window.localStorage.setItem('dark', value)
                    }

                    return {
                        loading: true,
                        isDark: getTheme(),
                        toggleTheme() {
                            this.isDark = !this.isDark
                            setTheme(this.isDark)
                        },
                    }
                }
            </script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="{{ asset('js/app.js') }}" defer></script>
            <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>

            <!-- Feather Light -->
            <script src="//code.jquery.com/jquery-latest.js"></script>
            <script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript"
                        charset="utf-8"></script>

            <!-- Flowbite Dropdown -->
            <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>

            {{-- My Scripts --}}
            @foreach ($scripts as $script)
                <script src="{{ $script }}"></script>
            @endforeach

            {{-- Livewire Scripts --}}
            @livewireScripts
</body>

</html>
