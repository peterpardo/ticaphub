<div class="mb-5">
    <ul class="flex gap-x-4 ">
        <li class="font-semibold @if($isActive === 'users') border-b-2 border-red-700 @endif">
            <a href="{{ route('users') }}">Users</a>
        </li>
        <li class="font-semibold @if($isActive === 'groups') border-b-2 border-red-700 @endif">
            <a href="{{ url('users/groups') }}">Groups</a>
        </li>
        <li class="font-semibold @if($isActive === 'advisers') border-b-2 border-red-700 @endif">
            <a href="#">Project Advisers</a>
        </li>
    </ul>
</div>
