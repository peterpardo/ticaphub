<x-app-layout title="Dashboard">
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Ticap name --}}
    <h1 class="font-bold text-3xl tracking-wide mb-5">{{ $ticap }}</h1>

    {{-- Report Cards (admin) --}}
    @role('superadmin')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Student Card --}}
            <x-dashboard.report-card name="students" count="{{ $students }}">
                {{-- Card Icon --}}
                <x-slot name="icon">
                    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </x-slot>
            </x-dashboard.report-card>

            {{-- Panelists Card --}}
            <x-dashboard.report-card name="panelists" count="{{ $panelists }}">
                {{-- Card Icon --}}
                <x-slot name="icon">
                    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                </x-slot>
            </x-dashboard.report-card>

            {{-- Officers Card --}}
            <x-dashboard.report-card name="officers" count="{{ $officers }}">
                {{-- Card Icon --}}
                <x-slot name="icon">
                    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="9" cy="7" r="4"></circle><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path><path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>
                </x-slot>
            </x-dashboard.report-card>

            {{-- Admins Card --}}
            <x-dashboard.report-card name="admins" count="{{ $admins }}">
                {{-- Card Icon --}}
                <x-slot name="icon">
                    <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </x-slot>
            </x-dashboard.report-card>
        </div>
    @endrole
</x-app-layout>
