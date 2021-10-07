<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div class="text-right">
        <a href="#" class="inline-block bg-green-500 hover:bg-green-600 px-2 py-1 rounded text-white">Review Results</a>
    </div>
    <h1 class="font-bold text-xl my-3 text-center">List of Panelists</h1>
    <table class="w-full mb-3">
        <thead>
            <tr>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Specialization</td>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Panelists</td>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach($panelists as $panelist)
                <tr>
                    <td class="px-2 py-2 text-mdg border">{{ $panelist->specialization->name}} ({{ $panelist->specialization->school->name}})</td>
                    <td class="px-2 py-2 text-mdg border">{{ $panelist->user->first_name }} {{ $panelist->user->middle_name }} {{ $panelist->user->last_name }}</td>
                    <td class="px-2 py-2 text-mdg border">
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
    <h1 class="font-bold text-xl my-3 text-center">Student Choice Votes</h1>
    <table class="w-full mb-3">
        <thead>
            <tr>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Specialization</td>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Group</td>
                <td class="bg-gray-100 px-2 py-2 text-lg border">Votes</td>
            </tr>
        </thead>
        <tbody>
            @foreach($specs as $spec)
                @foreach($spec->groups as $group)
                    <tr>
                        <td class="px-2 py-2 text-mdg border">{{ $spec->name}} ({{ $spec->school->name}})</td>
                        <td class="px-2 py-2 text-mdg border">{{ $group->name }}</td>
                        <td class="px-2 py-2 text-mdg border">{{ \App\Models\StudentChoiceVote::where('group_id', $group->id)->count() }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</x-app-layout>