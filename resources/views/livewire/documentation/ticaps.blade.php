<div x-data="{
    showDeleteModal: @entangle('showDeleteModal').defer,
}">
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    <div>
        Peter
    </div>

    <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>school</x-table.thead>
                <x-table.thead>specialization</x-table.thead>
                <x-table.thead>actions</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($specializations as $specialization)
                @if($specialization->school->is_involved)
                    <tr>
                        <x-table.tdata>{{ $specialization->school->name }}</x-table.tdata>
                        <x-table.tdata>{{ $specialization->name }}</x-table.tdata>
                        <x-table.tdata-actions>
                            <x-table.delete-btn wire:click="selectItem({{ $specialization->id }})"   />
                        </x-table.tdata-actions>
                    </tr>
                @endif
            @empty
                <tr>
                    <x-table.tdata>No Specializations are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $specializations->links() }}
        </x-slot>
    </x-table>

    {{-- <x-table>
        <x-slot name="heading">
            <tr>
                <x-table.thead>TICaP Name</x-table.thead>
                <x-table.thead>Action</x-table.thead>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse ($ticaps as $ticap)
                <tr>
                    <x-table.tdata>{{ $ticap->name }}</x-table.tdata>
                    <x-table.tdata-actions>
                        @if ($ticap->is_done)
                            <a href="#" class="inline-block text-white rounded p-2 text-xs tracking-wide bg-blue-600 hover:bg-red-blue" >
                                <i class="fa-solid fa-eye"></i>
                                <span class="hidden tracking-wide lg:inline-block">View</span>
                            </a>
                            <x-table.delete-btn wire:click="selectItem({{ $ticap->id }})"/>
                        @else
                            <span
                                class="relative inline-block px-3 py-1 font-semibold text-indigo-900 leading-tight">
                                <span aria-hidden
                                    class="absolute inset-0 bg-indigo-200 opacity-50 rounded-full"></span>
                                <span class="relative">Ongoing</span>
                            </span>
                        @endif
                    </x-table.tdata-actions>
                </tr>
            @empty
                <tr>
                    <x-table.tdata>No Ticaps are found</x-table.tdata>
                </tr>
            @endforelse
        </x-slot>

        <x-slot name="links">
            {{ $ticaps->links() }}
        </x-slot>
    </x-table> --}}

    {{-- Delete modal --}}
    <div x-cloak x-show="showDeleteModal">
        <x-modal>
            <x-modal.title>Delete Specialization</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently delete the specialization.</x-modal.description>
            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal('delete')">Cancel</x-app.button>
                <x-app.button color="red" wire:click.prevent="deleteItem">Yes, delete it.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
