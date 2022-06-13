@php
    // Get current user
    $user = App\Models\User::find(Auth::id());

    $navs = collect([
        (object) [
            'name' => 'User Accounts',
            'route' => route('users'),
            'hasAccess' => $user->hasRole('admin'), // Check whether user has access to the specified link
            'icon' => 'fa-solid fa-user'
        ],
        (object) [
            'name' => 'Schedules',
            'route' => route('schedules'),
            'hasAccess' => $user->hasRole('admin'),
            'icon' => 'fa-solid fa-calendar'
        ],
        (object) [
            'name' =>  'Officers',
            'route' => route('officers'),
            'hasAccess' => $user->hasAnyRole(['admin', 'student', 'officer']),
            'icon' => 'fa-solid fa-user-shield'
        ],
        (object) [
            'name' => 'Committee Heads',
            'route' => route('committee-heads'),
            'hasAccess' => $user->hasRole(['admin']),
            'icon' => 'fa-solid fa-user-group'
        ],
        (object) [
            'name' => 'Manage Events',
            'route' => route('events'),
            'hasAccess' => $user->hasPermissionTo('access events'),
            'icon' => 'fa-solid fa-calendar-check'
        ],
        (object) [
            'name' => 'Project Assessment',
            'route' => route('awards'),
            'hasAccess' => $user->hasRole('admin'),
            'icon' => 'fa-solid fa-diagram-project'
        ],
        (object) [
            'name' => 'Documentation',
            'route' => route('awards'),
            'hasAccess' => $user->hasRole('admin'),
            'icon' => 'fa-solid fa-file'
        ]
    ]);
@endphp

<div class="fixed flex flex-col top-14 left-0 w-14 hover:w-64 md:w-64 bg-red-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10 sidebar">
    <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
        {{-- Sidebar links --}}
        <ul class="flex flex-col py-4 space-y-1 overflow-y-hidden">
            {{-- App Logo --}}
            <li class="px-5 hidden md:block">
                <div class="flex flex-row items-center h-8">
                    <img src="{{ url('assets/ticap-logo.png') }}" class="w-10 h-8" alt="">
                    <span class="ml-2 text-sm tracking-wide truncate">TICAP HUB</span>
                </div>
            </li>

            {{-- Dashboard link --}}
            <x-app.sidebar-link route="{{ route('dashboard') }}" name="Dashboard" icon="fa-solid fa-border-all" />

            {{-- Loop all other links --}}
            @foreach ($navs as $nav)
                @if($nav->hasAccess)
                    <x-app.sidebar-link :route="$nav->route" :name="$nav->name" :icon="$nav->icon" />
                @endif
            @endforeach
        </ul>
    </div>
</div>
