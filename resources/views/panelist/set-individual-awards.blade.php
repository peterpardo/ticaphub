<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="font-bold text-xl mb-2 text-center">{{ $ticap->name }}</h1>
    <h1 class="font-semibold text-xl mb-2">{{ $user->specializationPanelist->specialization->name }}</h1>
    
    <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
            <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                <td class="px-2 py-2 text-lg border">Panelists</td>
                <td class="px-2 py-2 text-lg border">Status</td>
            </tr>
        </thead>
        <tbody class="w-auto bg-white text-center">
            @foreach($panelists as $panelist)
                <tr class="text-gray-800">
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
    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
        <p class="mb-2">Evaluation is finished. Please set the the individual awards to finalize the results. Note: All panelists must unanimously choose one individual winner</p>
      </div>
        <h1 class="font-semibold mb-2 text-lg text-center text-black">Set Individual Award Winners</h1>
        <form action="{{ route('set-individual-awards') }}" method="post">
        @csrf
        @foreach ($spec->awards->where('type', 'individual')->where('name', '!=', 'Best Project Adviser') as $award)
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
                        <td class="border text-md px-2 py-1">
                            <ul>
                                <li>
                                    <select name="groups[{{ $winner->group->id }}]" class="rounded w-full">
                                        <option value="">-- select student --</option>
                                        @foreach($winner->group->userGroups as $userGroup)
                                        <option value="{{ $userGroup->user->id }}">{{ $userGroup->user->first_name }} {{ $userGroup->user->middle_name }} {{ $userGroup->user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    @error('groups.' . $winner->group->id)
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        @endforeach
        <div class="text-center">
            <button type="submit" class="bg-green-500 hover:bg-green-600 px-2 py-1 rounded text-white">Submit</button>
        </div>
        </form>
    @else
        <h1 class="text-xl font-semibold mb-2 text-black">Results</h1>
        <div class="text-center bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
            <p class="font-bold">Waiting for Results</p>
          </div>
    @endif
</x-app-layout>