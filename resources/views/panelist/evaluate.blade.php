<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <h1 class="text-xl mb-1 text-center font-semibold">{{ $user->specializationPanelist->specialization->school->name }}</h1>
    <h1 class="text-xl mb-1 text-center font-semibold">{{ $user->specializationPanelist->specialization->name }}</h1>

    <form
        action="{{ route('evaluate-groups') }}"
        method="post">
        @csrf
    <div class="text-right">
        <button type="submit" class="rounded bg-green-500 hover:bg-green-600 px-2 py-1 text-white">Compute and Review</button>
    </div>
    {{-- AWARDS W/ RUBRICS --}}
    @foreach($user->specializationPanelist->specialization->awards as $award)
        <div class="my-5 py-2 px-2 rounded shadow-md overflow-x-scroll whitespace-nowrap">
            <h1 class="font-semibold text-lg">{{ $award->name }}</h1>
            {{-- GROUP CARDS --}}
            @foreach($user->specializationPanelist->specialization->groups as $group )
                <div class="rounded px-2 py-1 shadow mx-1 my-2 inline-block">
                    <h1 class="font-semibold text-md my-2 text-center text-gray-800 dark:text-white">{{ $group->name }}</h1>
                    @if(session($group->name . $award->id))
                        <div class="bg-red-500 my-1 py-1 text-center">{{ session('message') }}</div>
                    @endif

                    <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                <tr class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                                    <td class="bg-gray-200 px-2 py-1 text-center">Criteria</td>
                                    <td class="bg-gray-200 px-2 py-1 text-center">%</td>
                                    <td class="bg-gray-200 px-2 py-1 text-center">Grade</td>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300 text-gray-800">
                                @foreach($award->awardRubric->rubric->criteria  as $crit)
                                <tr>
                                    <td class="px-2 py-1 text-center">{{ $crit->name }}</td>
                                    <td class="px-2 py-1 text-center">{{ $crit->percentage }}</td>
                                    <td class="px-2 py-1 text-center">
                                        <ul>
                                            <li>
                                                <input type="number" class="border rounded" name="awards[{{ $award->id }}][{{ $group->id }}][{{ $crit->id }}]" placeholder="input grade" value="{{ old('awards.'.$award->id.'.'.$group->id.'.'.$crit->id) }}">
                                            </li>
                                            <li>
                                                @error('awards.'.$award->id.'.'.$group->id.'.'.$crit->id)
                                                    <span class="text-red-500 inline-block my-1">{{ $message }}</span>
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
                </div>
            @endforeach
        </div>
    @endforeach
    </form>
</x-app-layout>
