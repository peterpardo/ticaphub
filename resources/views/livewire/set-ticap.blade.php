<div x-data="{
    isOpen: false,
}">
    {{-- Alert --}}
    @if (session('status'))
        <x-alert.basic-alert color="{{ session('status') }}" message="{{ session('message') }}"/>
    @endif

    {{-- Set ticap button --}}
    <div class="flex items-center mx-auto w-96 h-96">
        <x-form>
            <x-form.form-control>
                <x-form.label>TICAP Name</x-form.label>
                <x-form.input-info>Please enter a unique TICAP name</x-form.input-info>
                <x-form.input placeholder="e.g. TICaP v9.0"/>
            </x-form.control>
            <div class="text-right">
                <x-app.button color="green" type="submit">Set Ticap</x-app.button>
            </div>
        </x-form>
    </div>
</div>
