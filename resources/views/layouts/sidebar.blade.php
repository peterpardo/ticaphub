@php
    // Get current user
    $user = App\Models\User::find(Auth::id());

    $navs = collect([
        (object) [
            'name' => 'User Accounts',              // name of sidebar link
            'route' => route('users'),              // route
            'hasAccess' => $user->hasRole('superadmin'), // Check whether user has access to the specified link
            'icon' => 'fa-solid fa-user'            // icon from FontAwesome
        ],
        // Schedules Link (temporarily disabled)
        // (object) [
        //     'name' => 'Schedules',
        //     'route' => route('schedules'),
        //     'hasAccess' => $user->hasRole('superadmin'),
        //     'icon' => 'fa-solid fa-calendar'
        // ],
        (object) [
            'name' =>  'Officers',
            'route' => route('officers'),
            'hasAccess' => $user->hasAnyRole(['superadmin', 'student', 'officer']),
            'icon' => 'fa-solid fa-user-shield'
        ],
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
        (object) [
            'name' => 'Project Assessment',
            'route' => route('awards'),
            'hasAccess' => $user->hasRole('superadmin'),
            'icon' => 'fa-solid fa-diagram-project'
        ],
        (object) [
            'name' => 'Documentation',
            'route' => route('awards'),
            'hasAccess' => $user->hasRole('superadmin'),
            'icon' => 'fa-solid fa-file'
        ]
    ]);
@endphp

{{-- Sidebar Component --}}
<div class="fixed flex flex-col top-0 left-0 w-16 filter drop-shadow hover:w-64 md:w-64 bg-red-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10">
    <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
        {{-- Sidebar links --}}
        <ul class="flex flex-col py-4 gap-y-1 overflow-hidden">
            {{-- App Logo --}}
            <li class="ml-3 mb-5 transition-all duration-300 md:ml-14">
                <div class="flex flex-row items-center">
                    <img src="{{ url('assets/ticap-logo.png') }}" class="w-10 h-10" alt="logo">
                    <span class="hidden ml-1 text-base tracking-wide md:inline-block">TICAP HUB</span>
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
        </ul>
    </div>
</div>
