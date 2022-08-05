<div x-data="{
    showDeleteModal: @entangle('showDeleteModal').defer,
}">
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can view all the past TICaPs and its files.
    </x-info-box>

    {{-- Ticap table --}}
    <x-table>
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
                            <a href="{{ url('documentation/' . $ticap->id) }}" class="inline-block text-white rounded p-2 text-xs tracking-wide bg-blue-600 hover:bg-red-blue" >
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
    </x-table>

    {{-- Delete modal --}}
    <div x-cloak x-show="showDeleteModal">
        <x-modal>
            <x-modal.title>Delete TICaP</x-modal.title>
            <x-modal.description>Are you sure? Continuing this will permanently delete the TICaP and its files.</x-modal.description>
            <div class="text-right">
                <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                <x-app.button color="red" wire:click.prevent="deleteItem">Yes, delete it.</x-app.button>
            </div>
        </x-modal>
    </div>
</div>
