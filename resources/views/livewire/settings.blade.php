<div>
    {{-- Navbar --}}
    @include('settings.navbar')

    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert :color="session('status')" :message="session('message')"/>
    @endif

    {{-- Note --}}
    <x-info-box color="yellow">
        Here, you can update the name of the TICaP event. Also, you can end the current TICaP and create a new one.
    </x-info-box>

    <div class="space-y-2 mt-5">
        {{-- Change TICaP name --}}
        <div class="flex flex-col items-start gap-y-2 border-b-2 border-gray-300 w-full max-w-2xl pb-5 md:flex-row md:items-center md:justify-between">
            <div class="space-y-2">
                <span class="block font-bold">Change TICaP name</span>
                <span class="block text-xs">The current TICaP name is <strong>"{{ $ticap->name }}"</strong></span>
            </div>
            <div class="self-end md:self-auto">
                <x-app.button color="blue">
                    <i class="fa-solid fa-pen mr-1"></i>
                    Change name
                </x-app.button>
            </div>
        </div>

        {{-- Reset Ticap --}}
        <div class="flex flex-col items-start gap-y-2 border-b-2 border-gray-300 w-full max-w-2xl pb-5 md:flex-row md:items-center md:justify-between">
            <div class="space-y-2">
                <span class="block font-bold">End current TICaP</span>
                <span class="block text-xs w-full max-w-md">Once you end the event, all of the users in the event will be deleted and all of the necessary files will be stored in the <strong>Documentation</strong> tab.</span>
            </div>
            <div class="self-end md:self-auto">
                <x-app.button color="red">
                    <i class="fa-solid fa-trash mr-1"></i>
                    End event
                </x-app.button>
            </div>
        </div>
    </div>
</div>
