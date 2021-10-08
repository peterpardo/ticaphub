<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="font-semibold mb-2 text-2xl text-center">Individual Award Winners</h1>
    @foreach($specs as $spec)
        <h1 class="font-semibold mb-2 text-lg">{{ $spec->name }} - {{ $spec->school->name }}</h1>
        @foreach ($spec->awards->where('type', 'individual') as $award)
            <table class="table-fixed w-full mb-3">
                <thead>
                    <tr>
                        <td class="border bg-gray-100 text-lg px-2 py-1">Award</td>
                        <td class="border bg-gray-100 text-lg px-2 py-1">Group</td>
                        <td class="border bg-gray-100 text-lg px-2 py-1">User Name</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($award->individualWinners as $winner)
                    <tr>
                        <td class="border text-md px-2 py-1">{{ $award->name }}</td>
                        <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                        @if($winner->user != null)
                            <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                        @else
                            <td class="border text-md px-2 py-1"><span class="text-red-500">waiting for panelist</span></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endforeach

    <h1 class="text-center font-semibold text-2xl mb-2">Group Award Winners</h1>
    @foreach($specs as $spec)
        <h1 class="font-semibold mb-2 text-lg">{{ $spec->name }} - {{ $spec->school->name }}</h1>
        @foreach ($spec->awards->where('type', 'group') as $award)
            <table class="table-fixed w-full mb-3">
                <thead>
                    <tr>
                        <td class="border bg-gray-100 text-lg px-2 py-1">Award</td>
                        <td class="border bg-gray-100 text-lg px-2 py-1">Group</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($award->groupWinners as $winner)
                    <tr>
                        <td class="border text-md px-2 py-1">{{ $award->name }}</td>
                        <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endforeach

    
    <h1 class="text-center font-semibold text-2xl mb-2">Student Choice Award Winners</h1>
    @foreach($specs as $spec)
        <h1 class="font-semibold mb-2 text-lg">{{ $spec->name }} - {{ $spec->school->name }}</h1>
        <table class="table-fixed w-full mb-3">
            <thead>
                <tr>
                    <td class="border bg-gray-100 text-lg px-2 py-1">Specialization</td>
                    <td class="border bg-gray-100 text-lg px-2 py-1">Group</td>
                </tr>
            </thead>
            <tbody>
                @foreach($spec->studentChoiceAwards as $winner)
                    <tr>
                        <td class="border text-md px-2 py-1">{{ $spec->name }}</td>
                        <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</x-app-layout>