<x-app-layout title="{{ $ticap->name }}">
    <x-app.button type="link" color="red" href="{{ route('documentation') }}" class="mb-5">
        <i class="fa-solid fa-arrow-left mr-2"></i>
        Go back
    </x-app.button>

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        You can download the assets of the previous group exhibits (group picture, poster, logo, etc.).
    </x-info-box>

    <div class="space-y-2 mt-5 max-w-2xl">
        {{-- Group exhibits --}}
        <div class="flex flex-col items-start gap-y-2 border-b-2 border-gray-300 w-full pb-5 md:flex-row md:items-center md:justify-between">
            <div class="space-y-2">
                <span class="block font-bold">Group Exhibits</span>
                <span class="block text-xs">This contains all of the assets used by the groups in the project exhibit.</span>
            </div>

            <div class="self-end md:self-auto">
                <a href="{{ url('documentation/download-exhibit-files/' . $ticap->id) }}" class="text-blue-700 hover:text-blue-500 text-sm">
                    Download
                    <i class="fa-solid fa-download ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
