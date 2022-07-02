<div class="mb-5">
    <ul class="flex gap-x-4 ">
        <li class="font-semibold @if($isActive === 'settings') border-b-2 border-red-700 @endif">
            <a href="{{ route('settings') }}">TICaP Settings</a>
        </li>
        <li class="font-semibold @if($isActive === 'specializations') border-b-2 border-red-700 @endif">
            <a href="{{ url('users/groups') }}">Specializations</a>
        </li>
    </ul>
</div>
