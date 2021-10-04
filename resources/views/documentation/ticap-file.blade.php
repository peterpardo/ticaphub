<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div class="flex">
        <div class="flex-1 mx-1 px-2 py-1 shadow rounded">
            <h1 class="font-semibold text-2xl my-2">Events</h1>
            @foreach ($ticap->archivedEvents as $event)
            <div>
                <div class="text-xl font-semibold">{{ $event->name }}</div>
                <div>Program flow/s:</div>
                <ul class="list-disc list-inside">
                    @foreach($event->archivedPrograms as $program)
                    <li>
                        <a href="{{ Storage::url($program->path) }}" target="_blank" class="text-blue-500 hover:text-blue-600 underline">{{ $program->name }}</a>
                    </li>
                    @endforeach
                </ul>
                <div>Files</div>
                @if($event->archivedFiles()->count() == 0)
                    <div class="bg-gray-100 py-5 text-center rounded my-2">No files uploaded</div>
                @else
                <ul class="list-inside list-disc">
                    @foreach ($event->archivedFiles as $file)
                    <li>
                        <a href="/event-files/{{ $file->path }}" class="text-blue-500 hover:text-blue-600 underline">{{ $file->name }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            @endforeach
        </div>

        <div class="flex-1 mx-1 px-2 py-1 shadow rounded">
            <h1 class="font-semibold text-2xl my-2">Officers</h1>
            @if($ticap->archivedOfficers()->count() == 0)
                <div class="bg-gray-100 py-5 text-center rounded my-2">No files uploaded</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <td class="border px-3 py-2 font-semibold">File Name</td>
                            <td class="border px-3 py-2 font-semibold">Actions</td>
                        </tr>
                    </thead>
                    <tr>
                        <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedOfficers->name }}.pdf</td>
                        <td class="border px-3 py-2">
                            <a href="{{ Storage::url($ticap->archivedOfficers->path) }}" target="_blank" class="bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">Download</a>
                        </td>
                    </tr>
                </table>
            @endif
            <h1 class="font-semibold text-2xl my-2">Capstone Groups</h1>
            @if($ticap->archivedGroups()->count() == 0)
                <div class="bg-gray-100 py-5 text-center rounded my-2">No files uploaded</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <td class="border px-3 py-2 font-semibold">File Name</td>
                            <td class="border px-3 py-2 font-semibold">Actions</td>
                        </tr>
                    </thead>
                    <tr>
                        <td class="border px-3 py-2 text-blue-500">{{ $ticap->archivedGroups->name }}.pdf</td>
                        <td class="border px-3 py-2">
                            <a href="{{ Storage::url($ticap->archivedGroups->path) }}" target="_blank" class="bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white rounded">Download</a>
                        </td>
                    </tr>
                </table>
            @endif
            <h1 class="font-semibold text-2xl my-2">Capstone Group Files</h1>
            @foreach($ticap->archivedExhibits as $exhibit)
                <div>{{ $exhibit->name }}</div>
                @if($exhibit->files()->count() == 0)
                    <div class="bg-gray-100 py-5 text-center rounded my-2">No files uploaded</div>
                @else
                <ul class="list-inside list-disc">
                    @foreach ($exhibit->files as $file)
                    <li>
                        <a href="{{ Storage::url($file->path) }}" target="_blank" class="text-blue-500 hover:text-blue-600 underline">{{ $file->name }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>