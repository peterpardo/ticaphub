<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="font-bold text-xl mb-2 text-center">{{ $ticap->name }}</h1>
    
    {{-- INDIVIDUAL AWARD WINNERS --}}
    <h1 class="font-semibold mb-2 text-2xl text-center">Individual Award Winners</h1>
    <h1 class="font-semibold mb-2 text-lg">{{ $user->specializationPanelist->specialization->name }} - {{ $user->specializationPanelist->specialization->school->name }}</h1>
    @foreach ($user->specializationPanelist->specialization->awards->where('type', 'individual') as $award)
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
                        <td class="border text-md px-2 py-1">{{ $winner->user->first_name }} {{ $winner->user->middle_name }} {{ $winner->user->last_name }}</td>
                    @else
                        <td class="border text-md px-2 py-1"><span class="text-red-500">processing</span></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    {{-- GROUP AWARD WINNERS --}}
    <h1 class="text-center font-semibold text-2xl mb-2">Group Award Winners</h1>
    @foreach ($user->specializationPanelist->specialization->awards->where('type', 'group') as $award)
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

    {{-- STUDENT CHOICE AWARD WINNER/S --}}
    <h1 class="text-center font-semibold text-2xl mb-2">Student Choice Award Winners</h1>
    <table class="table-fixed w-full mb-3">
        <thead>
            <tr>
                <td class="border bg-gray-100 text-lg px-2 py-1">Group</td>
            </tr>
        </thead>
        <tbody>
            @foreach($user->specializationPanelist->specialization->studentChoiceAwards as $winner)
                <tr>
                    <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>