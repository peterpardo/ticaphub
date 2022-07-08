@php
    // Get current user
    $user = App\Models\User::find(auth()->user()->id);

    $navs = collect([
        (object) [
            'name' => 'User Accounts',              // name of sidebar link
            'route' => route('users'),              // route
            'hasAccess' => $user->hasAnyRole('superadmin', 'admin') || $user->hasPermissionTo('access user accounts'), // Check whether user has access to the specified link
            'icon' => 'fa-solid fa-user'            // icon from FontAwesome
        ],
        (object) [
            'name' =>  'Officers',
            'route' => $user->hasAnyRole('superadmin', 'admin') ? url('officers/elections') : url('officers/' . $user->userElection->election_id),
            'hasAccess' => $user->hasAnyRole('superadmin', 'admin', 'student'),
            'icon' => 'fa-solid fa-user-shield'
        ],
        (object) [
            'name' => 'Settings',              // name of sidebar link
            'route' => route('settings'),              // route
            'hasAccess' => $user->hasRole('superadmin'), // Check whether user has access to the specified link
            'icon' => 'fa-solid fa-gears'            // icon from FontAwesome
        ],
        // Schedules Link (temporarily disabled)
        // (object) [
        //     'name' => 'Schedules',
        //     'route' => route('schedules'),
        //     'hasAccess' => $user->hasRole('superadmin'),
        //     'icon' => 'fa-solid fa-calendar'
        // ],
        // (object) [
        //     'name' => 'Committee Heads',
        //     'route' => route('committee-heads'),
        //     'hasAccess' => $user->hasRole(['superadmin']),
        //     'icon' => 'fa-solid fa-user-group'
        // ],
        // Manage Events Link (temporarily disabled)
        // (object) [
        //     'name' => 'Manage Events',
        //     'route' => route('events'),
        //     'hasAccess' => $user->hasPermissionTo('access events'),
        //     'icon' => 'fa-solid fa-calendar-check'
        // ],
        // (object) [
        //     'name' => 'Project Assessment',
        //     'route' => route('awards'),
        //     'hasAccess' => $user->hasRole('superadmin'),
        //     'icon' => 'fa-solid fa-diagram-project'
        // ],
    ]);
@endphp

{{-- Sidebar Component --}}
<div class="fixed flex flex-col top-0 left-0 w-16 filter drop-shadow hover:w-64 lg:w-64 bg-red-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10">
    <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
        {{-- Sidebar links --}}
        <ul class="flex flex-col py-4 gap-y-1 overflow-hidden">
            {{-- App Logo --}}
            <li class="ml-3 mb-5 transition-all duration-300 lg:ml-14">
                <div class="flex flex-row items-center">
                    <img src="{{ url('assets/ticap-logo.png') }}" class="w-10 h-10" alt="logo">
                    <span class="hidden ml-1 text-base tracking-wide lg:inline-block">TICAPHUB</span>
                </div>
            </li>

            {{-- Dashboard link --}}
            <x-app.sidebar-link route="{{ route('dashboard') }}" name="Dashboard" icon="fa-solid fa-border-all" />

            {{-- Loop all other links --}}
            {{-- Hide Sidebar links if ticap is not set --}}
            @if ($showSidebar)
                @foreach ($navs as $nav)
                    @if($nav->hasAccess)
                        <x-app.sidebar-link :route="$nav->route" :name="$nav->name" :icon="$nav->icon" />
                    @endif
                @endforeach
            @endif

            {{-- Documentation link --}}
            @role('superadmin')
                <x-app.sidebar-link route="{{ route('documentation') }}" name="Documentation" icon="fa-solid fa-file" />
            @endrole
        </ul>
    </div>
</div>
