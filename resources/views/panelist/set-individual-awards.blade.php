<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="font-bold text-xl mb-2 text-center">{{ $ticap->name }}</h1>
    <h1 class="font-semibold text-xl mb-2">{{ $user->specializationPanelist->specialization->name }}</h1>
    
    <table class="w-full mb-3">
        <thead>
            <tr>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Panelists</td>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach($panelists as $panelist)
                <tr>
                    <td class="px-2 py-2 text-lg border">{{ $panelist->user->first_name }} {{ $panelist->user->middle_name }} {{ $panelist->user->last_name }}</td>
                    <td class="px-2 py-2 text-lg border">
                        @if($panelist->is_done)
                            <span class="text-green-500">done</span>
                        @else
                        <span class="text-red-500">evaluating</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($ticap->finalize_award)
        <div class="px-2 text-center py-5 mb-2 rounded bg-green-100 ">
            <p>Evaluation is finished. Please set the the individual awards to finalize the results.</p>
        </div>
        <h1 class="font-semibold mb-2 text-lg text-center">Set Individual Award Winners</h1>
        <form action="{{ route('set-individual-awards') }}" method="post">
        @csrf
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
                        <td class="border text-md px-2 py-1">
                            <ul>
                                <li>
                                    <select name="group[{{ $winner->group->id }}]" class="rounded w-full">
                                        <option value="">-- select student --</option>
                                        @foreach($winner->group->userGroups as $userGroup)
                                        <option value="{{ $userGroup->user->id }}">{{ $userGroup->user->first_name }} {{ $userGroup->user->middle_name }} {{ $userGroup->user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    @error('group.' . $winner->group->id)
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
        <div class="text-center">
            <button type="submit" class="bg-green-500 hover:bg-green-600 px-2 py-1 rounded text-white">Submit</button>
        </div>
        </form>
    @else
        <h1 class="text-xl font-semibold mb-2">Results</h1>
        <div class="bg-gray-100 py-5 text-center rounded">Waiting for Results</div>
    @endif
</x-app-layout>