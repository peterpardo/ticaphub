<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="font-bold text-xl mb-2 text-center">{{ $ticap->name }}</h1>
    
    {{-- INDIVIDUAL AWARD WINNERS --}}
    <h1 class="font-semibold mb-2 text-2xl text-center">Individual Award Winners</h1>
    <h1 class="font-semibold mb-2 text-lg">{{ $user->specializationPanelist->specialization->name }} - {{ $user->specializationPanelist->specialization->school->name }}</h1>
    @foreach ($user->specializationPanelist->specialization->awards->where('type', 'individual') as $award)
    <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                    <td class="border text-lg px-2 py-1">Award</td>
                    <td class="border text-lg px-2 py-1">Group</td>
                    <td class="border text-lg px-2 py-1">User Name</td>
                </tr>
            </thead>
            <tbody class="w-auto bg-white text-center">
                @foreach($award->individualWinners as $winner)
                <tr class="text-gray-800">
                    <td class="border text-md px-2 py-1">{{ $award->name }}</td>
                    <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                    @if($winner->name != null)
                        <td class="border text-md px-2 py-1">{{ $winner->name }}</td>
                    @else
                        <td class="border text-md px-2 py-1"><span class="text-red-500">processing</span></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    @endforeach

    {{-- GROUP AWARD WINNERS --}}
    <h1 class="text-center font-semibold text-2xl mb-2">Group Award Winners</h1>
    @foreach ($user->specializationPanelist->specialization->awards->where('type', 'group') as $award)
    <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                    <td class="border text-lg px-2 py-1">Award</td>
                    <td class="border text-lg px-2 py-1">Group</td>
                </tr>
            </thead>
            <tbody class="w-auto bg-white text-center">
                @foreach($award->groupWinners as $winner)
                <tr class="text-gray-800">
                    <td class="border text-md px-2 py-1">{{ $award->name }}</td>
                    <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    @endforeach

    {{-- STUDENT CHOICE AWARD WINNER/S --}}
    <h1 class="text-center font-semibold text-2xl mb-2">Student Choice Award Winners</h1>
    <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                <td class="border text-lg px-2 py-1">Group</td>
            </tr>
        </thead>
        <tbody class="w-auto bg-white text-center">
            @foreach($user->specializationPanelist->specialization->studentChoiceAwards as $winner)
                <tr class="text-gray-800">
                    <td class="border text-md px-2 py-1">{{ $winner->group->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

</x-app-layout>