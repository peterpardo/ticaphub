<div>
    {{-- Candidates table --}}
    <x-table>
        <x-slot name="heading">
            <x-table.thead>Position</x-table.thead>
            <x-table.thead>Candidate/s</x-table.thead>
        </x-slot>

        <x-slot name="body">
            @forelse ($positions as $position)
                <tr>
                    <x-table.tdata>{{ $position->name }}</x-table.tdata>
                    <x-table.tdata>
                        <div class="space-y-2">
                            @forelse ($position->candidates as $candidate)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                            <img
                                                class="w-full object-cover"
                                                @if (is_null($candidate->user->profile_picture))
                                                    src="{{ url(asset('assets/default-img.png')) }}"
                                                @else
                                                    src="{{ url(asset($candidate->user->profile_picture)) }}"
                                                    @endif
                                                    alt="profile_picture" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $candidate->user->fullname }}
                                                    </p>
                                                </div>
                                        </div>
                                    <div>
                                        <x-table.delete-btn />
                                        <x-table.edit-btn type="button" />
                                    </div>
                                </div>
                            @empty
                                No candidates found
                            @endforelse
                        </div>
                    </x-table.tdata>
                </tr>
            @empty
                <x-table.tdata>No candidates found</x-table.tdata>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $positions->links() }}
        </x-slot>
    </x-table>
</div>
