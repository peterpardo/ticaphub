<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles

    </head>
    <body class="bg-gray-100">
        <nav class="flex items-center bg-red-800 p-3 justify-center">
            <a href="{{ route ('home') }}" class="p-2 mr-4 inline-flex items-center">
                <img class="w-7 h-7" src="{{ url(asset('assets/ticap-logo.png')) }}" alt="">
                <span  class="text-xl text-white font-bold uppercase tracking-wide"
                >TICaP HUB</span>
            </a>
        </nav>
        
        @livewire('student-choice-vote-form', ['groupId' => $groupId])
        @livewireScripts

        {{-- SCRIPTS --}}
        <script>
            Livewire.on('confirmVote', () => {
                alert('Vote successfully submitted');
            });
        </script>
    </body>
</html>