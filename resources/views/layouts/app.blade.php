<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" id="ticap-token">
        <title>{{ config('app.name', 'TICaP HUB') }}</title>
        <link rel="icon" class="w-10 h-10" href="{{ url('assets/ticap-logo.png') }}"/>

        <!-- Feather Light -->
        <link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            [x-cloak] { display: none !important; }
            /* Compiled dark classes from Tailwind */
            .dark .dark\:divide-gray-700 > :not([hidden]) ~ :not([hidden]) {
                border-color: rgba(55, 65, 81);
            }
            .dark .dark\:bg-gray-50 {
                background-color: rgba(249, 250, 251);
            }
            .dark .dark\:bg-gray-100 {
                background-color: rgba(243, 244, 246);
            }
            .dark .dark\:bg-gray-600 {
                background-color: rgba(75, 85, 99);
            }
            .dark .dark\:bg-gray-700 {
                background-color: rgba(55, 65, 81);
            }
            .dark .dark\:bg-gray-800 {
                background-color: rgba(31, 41, 55);
            }
            .dark .dark\:bg-gray-900 {
                background-color: rgba(17, 24, 39);
            }
            .dark .dark\:bg-red-700 {
                background-color: rgba(185, 28, 28);
            }
            .dark .dark\:bg-green-700 {
                background-color: rgba(4, 120, 87);
            }
            .dark .dark\:hover\:bg-gray-200:hover {
                background-color: rgba(229, 231, 235);
            }
            .dark .dark\:hover\:bg-gray-600:hover {
                background-color: rgba(75, 85, 99);
            }
            .dark .dark\:hover\:bg-gray-700:hover {
                background-color: rgba(55, 65, 81);
            }
            .dark .dark\:hover\:bg-gray-900:hover {
                background-color: rgba(17, 24, 39);
            }
            .dark .dark\:border-gray-100 {
                border-color: rgba(243, 244, 246);
            }
            .dark .dark\:border-gray-400 {
                border-color: rgba(156, 163, 175);
            }
            .dark .dark\:border-gray-500 {
                border-color: rgba(107, 114, 128);
            }
            .dark .dark\:border-gray-600 {
                border-color: rgba(75, 85, 99);
            }
            .dark .dark\:border-gray-700 {
                border-color: rgba(55, 65, 81);
            }
            .dark .dark\:border-gray-900 {
                border-color: rgba(17, 24, 39);
            }
            .dark .dark\:hover\:border-gray-800:hover {
                border-color: rgba(31, 41, 55);
            }
            .dark .dark\:text-white {
                color: rgba(255, 255, 255);
            }
            .dark .dark\:text-gray-50 {
                color: rgba(249, 250, 251);
            }
            .dark .dark\:text-gray-100 {
                color: rgba(243, 244, 246);
            }
            .dark .dark\:text-gray-200 {
                color: rgba(229, 231, 235);
            }
            .dark .dark\:text-gray-400 {
                color: rgba(156, 163, 175);
            }
            .dark .dark\:text-gray-500 {
                color: rgba(107, 114, 128);
            }
            .dark .dark\:text-gray-700 {
                color: rgba(55, 65, 81);
            }
            .dark .dark\:text-gray-800 {
                color: rgba(31, 41, 55);
            }
            .dark .dark\:text-red-100 {
                color: rgba(254, 226, 226);
            }
            .dark .dark\:text-green-100 {
                color: rgba(209, 250, 229);
            }
            .dark .dark\:text-red-400 {
                color: rgba(96, 165, 250);
            }
            .dark .group:hover .dark\:group-hover\:text-gray-500 {
                color: rgba(107, 114, 128);
            }
            .dark .group:focus .dark\:group-focus\:text-gray-700 {
                color: rgba(55, 65, 81);
            }
            .dark .dark\:hover\:text-gray-100:hover {
                color: rgba(243, 244, 246);
            }
            .dark .dark\:hover\:text-red-500:hover {
                color: rgba(59, 130, 246);
            }

            /* Custom style */
            .header-right {
                width: calc(100% - 3.5rem);
            }
            .sidebar:hover {
                width: 16rem;
            }
            @media only screen and (min-width: 768px) {
                .header-right {
                    width: calc(100% - 16rem);
                }
            }
            .dropdown:hover > .dropdown-content {
                display: block;
            }
        </style>

        {{-- Livewire Styles--}}
        @livewireStyles

    </head>

    <body>
        <div x-data="setup()" :class="{ 'dark': isDark }">
            <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">
                <!-- Header -->
                <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
                    {{-- Profile Picture and Name --}}
                    <div class="flex items-center justify-start md:justify-between pl-1 w-14 md:w-64 h-14 bg-red-800 dark:bg-gray-800 border-none">
                        <div class="flex justify-between items-center">
                            <div class="flex justify-between items-center mr-2">
                                @if(Auth::user()->profile_picture)
                                    <img class="w-12 h-12 rounded-full" src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="" loading="lazy" />
                                @else
                                    <img class="w-12 h-12 rounded-full" src="{{ url(asset('assets/default-img.png')) }}" alt="" loading="lazy" />
                                @endif
                            </div>
                            <span class="hidden md:inline-block">Hello, {{ Auth::user()->first_name}}!</span>
                        </div>
                    </div>

                <div class="flex justify-between items-center h-14 bg-red-800 dark:bg-gray-800 header-right">
                    {{-- Space between Profile Picture and Dropdown Menu --}}
                    <div class="flex items-center w-full max-w-xl mr-4 p-2 "></div>

                    <ul class="flex items-center">
                        {{-- Dark Mode Toggle --}}
                        {{-- <li>
                        <button
                            aria-hidden="true"
                            @click="toggleTheme"
                            class="group p-2 transition-colors duration-200 rounded-full shadow-md bg-red-200 hover:bg-red-200 dark:bg-gray-50 dark:hover:bg-gray-200 text-gray-900 focus:outline-none"
                        >
                            <svg
                            x-show="isDark"
                            width="24"
                            height="24"
                            class="fill-current text-gray-700 group-hover:text-gray-500 group-focus:text-gray-700 dark:text-gray-700 dark:group-hover:text-gray-500 dark:group-focus:text-gray-700"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke=""
                            >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                            />
                            </svg>
                            <svg
                            x-show="!isDark"
                            width="24"
                            height="24"
                            class="fill-current text-gray-700 group-hover:text-gray-500 group-focus:text-gray-700 dark:text-gray-700 dark:group-hover:text-gray-500 dark:group-focus:text-gray-700"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke=""
                            >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                            />
                            </svg>
                        </button>
                        </li>
                        <li>
                        <div class="block w-px h-6 mx-3  bg-gray-400 dark:bg-gray-700"></div>
                        </li> --}}

                        {{-- Dropdown Menu --}}
                        <div class="dropdown inline-block relative">
                            <button class="text-white font-semibold py-3 px-9 rounded inline-flex items-center">
                                <span>Menu</span>
                            </button>

                            <ul class="dropdown-content absolute hidden text-white text-sm text-left pt-1">
                                <li>
                                    <a class="bg-red-800 hover:bg-red-600 py-2 px-10 block whitespace-no-wrap dark:bg-gray-800 dark:hover:bg-gray-600" href="{{ route('profile.update') }}">
                                        Manage Profile
                                    </a>
                                </li>

                                {{-- Logout Button --}}
                                <li>
                                    <form
                                        method="POST"
                                        action="{{ route('logout') }}">
                                        @csrf
                                            <a class="rounded-b z-50 bg-red-800 hover:bg-red-600 py-2 px-10 block whitespace-no-wrap dark:bg-gray-800 dark:hover:bg-gray-600" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
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
            <div class="fixed flex flex-col top-14 left-0 w-14 hover:w-64 md:w-64 bg-red-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10 sidebar">
                <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
                    <ul class="flex flex-col py-4 space-y-1 overflow-y-hidden">
                        <li class="px-5 hidden md:block">
                        <div class="flex flex-row items-center h-8">
                            <img src="{{ url('assets/ticap-logo.png') }}" class="w-10 h-8"alt="">
                            <span class="ml-2 text-sm tracking-wide truncate">TICAP HUB</span>
                        </div>
                        </li>

                        <li>
                        <a href="{{ route('dashboard') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                        </a>
                        </li>

                        @can('access users')
                            <li>
                            <a href="{{ route('users') }}"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">User Accounts</span>
                            </a>
                            </li>
                        @endcan

                        @role('admin')
                            <li>
                            <a href="{{ route('schedules') }}"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Schedules</span>
                            </a>
                            </li>
                        @endrole

                        @if(Auth::user()->hasAnyRole('admin', 'student', 'officer'))
                            <li>
                            <a href="{{ route('officers') }}"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Officers</span>
                            </a>
                            </li>
                        @endif

                        @role('admin')
                            <li>
                            <a href="{{ route('committee-heads') }}"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"</path></svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Committee Heads</span>
                            </a>
                            </li>
                        @endrole

                        @can('access events')
                            <li>
                            <a href="{{ route('events') }}"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Manage Events</span>
                            </a>
                            </li>
                        @endcan

                        {{-- Check if user is a Committee Member or Committee Head --}}
                        @if(Auth::user()->committeeMember()->exists() || Auth::user()->committee()->exists())
                            <li>
                            @if(Auth::user()->committeeMember()->exists())
                                <a href="/committee/{{ Auth::user()->committeeMember->committee->id }}"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                            @elseif(Auth::user()->committee()->exists())
                                <a href="/committee/{{ Auth::user()->committee->id }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                            @endif
                                    <span class="inline-flex justify-center items-center ml-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    </span>

                                    @if(Auth::user()->committeeMember()->exists())
                                        <span class="ml-2 text-sm tracking-wide truncate">{{ Auth::user()->committeeMember->committee->name }} Committee</span>
                                    @elseif(Auth::user()->committee()->exists())
                                        <span class="ml-2 text-sm tracking-wide truncate">{{ Auth::user()->committee->name }} Committee</span>
                                    @endif
                                </a>
                            </li>
                        @endif

                        @can('access awards')
                            <li>
                                <a href="{{ route('assessment-panel') }}"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                    <span class="inline-flex justify-center items-center ml-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/><path d="M14 3v5h5M16 13H8M16 17H8M10 9H8"/></svg>
                                    </span>

                                    <span class="ml-2 text-sm tracking-wide truncate">Project Assessment</span>
                                </a>
                            </li>
                        @endcan

                        @can('access documents')
                            <li>
                                <a href="{{ route('documentation') }}"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                    <span class="inline-flex justify-center items-center ml-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                    </span>

                                    <span class="ml-2 text-sm tracking-wide truncate">Documentation</span>
                                </a>
                            </li>
                        @endcan

                        @can('access group exhibit')
                            <li>
                                <a href="{{ route('exhibit') }}"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                    <span class="inline-flex justify-center items-center ml-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                    </span>

                                    <span class="ml-2 text-sm tracking-wide truncate">{{ Auth::user()->userGroup->group->name . ' Exhibit' }}</span>
                                </a>
                            </li>
                        @endcan

                        @can('evaluate')
                            <li>
                                <a href="{{ route('evaluate-groups') }}"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                    <span class="inline-flex justify-center items-center ml-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/><path d="M14 3v5h5M16 13H8M16 17H8M10 9H8"/></svg>
                                    </span>

                                    <span class="ml-2 text-sm tracking-wide truncate">Evaluate Capstone Groups</span>
                                </a>
                            </li>
                        @endcan

                        <li>
                            <a href="/" target="_blank" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                <span class="inline-flex justify-center items-center ml-4">
                                    <svg class= "w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                                    </svg>
                                </span>

                                <span class="ml-2 text-sm tracking-wide truncate">Home Page</span>
                            </a>
                        </li>

                        @role('admin')
                            <div class="overflow-y-hidden overflow-x-hidden flex flex-col justify-between flex-grow">
                                <button class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6" type="button" data-dropdown-toggle="dropdown"><span class="inline-flex justify-center items-center">
                                    <span class="inline-flex justify-center items-center mx-4">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                                        </svg>
                                    </span>

                                    Settings

                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div class="hidden text-base z-50 list-none divide-y divide-gray-100 rounded shadow my-4" id="dropdown">
                                    <ul class="py-1" aria-labelledby="dropdown">
                                        <li>
                                            <a href="{{ route('home.slider') }}"  class="bg-red-800 dark:bg-gray-900 relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                                <span class="inline-flex justify-center items-center ml-4">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                                                    </svg>
                                                </span>

                                                <span class="ml-2 text-sm tracking-wide truncate">Home Slider</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('home.stream') }}"  class="bg-red-800 dark:bg-gray-900 relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                                <span class="inline-flex justify-center items-center ml-4">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                                                    </svg>
                                                </span>

                                                <span class="ml-2 text-sm tracking-wide truncate">Home Stream</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('home.brand') }}"  class="bg-red-800 dark:bg-gray-900 relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-red-500 dark:hover:border-gray-800 pr-6">
                                                <span class="inline-flex justify-center items-center ml-4">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                                                    </svg>
                                                </span>

                                                <span class="ml-2 text-sm tracking-wide truncate">TICaP Events</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endrole
                    </ul>
                </div>
            </div>
            {{-- Sidebar --}}

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
        <script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

        <!-- Flowbite Dropdown -->
        <script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>

        {{-- My Scripts --}}
        @foreach($scripts as $script)
            <script src="{{ $script }}"></script>
        @endforeach

        {{-- Livewire Scripts --}}
        @livewireScripts
    </body>
</html>
