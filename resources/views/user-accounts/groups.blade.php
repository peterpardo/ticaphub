<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>

    <a href="/users" class="bg-red-500 hover:bg-red-600 rounded text-white px-2 py-1">Back</a>

    <h1 class="text-center text-2xl font-semibold my-1">Capstone Groups</h1>

    @if ($groups->count() == 0)
        <div class="bg-gray-100 rounded my-1 text-center py-5">No groups</div>
    @else
        <div class="bg-white w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full table-fixed text-center">
                    <thead>
                        <tr
                            class="text-center text-md font-semibold tracking-wide text-gray-900 bg-indigo-100 uppercase border-b border-gray-600">
                            <td class="font-semibold text-lg border">Group</td>
                            <td class="font-semibold text-lg border">School</td>
                            <td class="font-semibold text-lg border">Specialization</td>
                            <td class="font-semibold text-lg border">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <td class="px-2 py-1 border">{{ $group->name }}</td>
                                <td class="px-2 py-1 border">{{ $group->specialization->name }}</td>
                                <td class="px-2 py-1 border">{{ $group->specialization->school->name }}</td>
                                <td class="px-2 py-1 border flex justify-center">
                                    <a href="/users/groups/{{ $group->id }}"
                                        class="flex items-center mx-1 px-2 py-1 rounded bg-yellow-500 hover:bg-yellow-600 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="ml-2">View</span>
                                    </a>

                                    <a href="/users/groups/{{ $group->id }}/edit"
                                        class="flex items-center mx-1 px-2 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd"
                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2">Edit</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-app-layout>
