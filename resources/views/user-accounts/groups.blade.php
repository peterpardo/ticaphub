<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>

    <a href="/users" class="bg-red-500 hover:bg-red-600 rounded text-white px-2 py-1">Back</a>

    <h1 class="text-center text-2xl font-semibold my-1">Capstone Groups</h1>

    <table class="mt-3 w-full table-fixed">
        <thead>
            <tr class="rounded-t-lg">
                <td class="bg-gray-100 px-2 py-1 font-semibold text-lg border">Group</td>
                <td class="bg-gray-100 px-2 py-1 font-semibold text-lg border">School</td>
                <td class="bg-gray-100 px-2 py-1 font-semibold text-lg border">Specialization</td>
                <td class="bg-gray-100 px-2 py-1 font-semibold text-lg border">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                <tr>
                    <td class="px-2 py-1 border">{{ $group->name }}</td>
                    <td class="px-2 py-1 border">{{ $group->specialization->name }}</td>
                    <td class="px-2 py-1 border">{{ $group->specialization->school->name }}</td>
                    <td class="px-2 py-1 border flex justify-center">
                        <a href="/users/groups/{{ $group->id }}" class="flex items-center px-2 py-1 rounded bg-blue-500 hover:bg-blue-600 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span class="ml-2">View</span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
