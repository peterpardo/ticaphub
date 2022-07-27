@php
    // Get current user
    $user = App\Models\User::find(auth()->user()->id);
@endphp

{{-- Sidebar Component --}}
<div class="fixed flex flex-col top-0 left-0 w-16 filter drop-shadow hover:w-64 lg:w-64 bg-red-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10">
    <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
        {{-- Sidebar links --}}
        <ul class="flex flex-col py-4 gap-y-1 overflow-hidden">
            {{-- App Logo --}}
            <li class="ml-3 mb-5 transition-all duration-300 lg:ml-14">
                <a href="{{ route('home') }}" class="flex flex-row items-center">
                    <img src="{{ url('assets/ticap-logo.png') }}" class="w-10 h-10" alt="logo">
                    <span class="hidden ml-1 text-base tracking-wide lg:inline-block">TICAPHUB</span>
                </a>
            </li>

            {{-- Dashboard link --}}
            <x-app.sidebar-link route="{{ route('dashboard') }}" name="Dashboard" icon="fa-solid fa-border-all" />

            {{-- Users link --}}
            @if($user->hasAnyRole('superadmin', 'admin') || $user->hasPermissionTo('access user accounts'))
                <x-app.sidebar-link route="{{ route('users') }}" name="User Accounts" icon="fa-solid fa-user" />
            @endif

            {{-- Officers link --}}
            @hasanyrole('superadmin|admin|student')
                <x-app.sidebar-link route="{{ $user->hasAnyRole('superadmin', 'admin') ? url('officers/elections') : url('officers/' . $user->userElection->election_id) }}" name="Officers" icon="fa-solid fa-user-shield" />
            @endhasanyrole

            {{-- Group exhibit link (for students only) --}}
            @if($user->hasRole('student') && !is_null($user->userSpecialization->group_id))
                <x-app.sidebar-link route="{{ route('group-exhibit') }}" name="Group Exhibit" icon="fa-solid fa-users-line" />
            @endif

            {{-- Documentation link --}}
            @role('superadmin')
            <x-app.sidebar-link route="{{ route('documentation') }}" name="Documentation" icon="fa-solid fa-file" />
            @endrole

            {{-- Settings link --}}
            @hasrole('superadmin')
                <x-app.sidebar-link route="{{ route('settings') }}" name="Settings" icon="fa-solid fa-gears" />
            @endhasrole
        </ul>
    </div>
</div>
