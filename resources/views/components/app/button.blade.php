{{-- Button for "Cancel" --}}
@if ($color === 'gray')
    <button {{ $attributes->merge(['type' => 'button']) }} class="py-2 px-4 rounded-lg text-black drop-shadow-lg bg-{{ $color }}-100 hover:bg-{{ $color }}-200">
        {{ $slot }}
    </button>
@else
    <button {{ $attributes->merge(['type' => 'button']) }} class="py-2 px-4 text-white rounded-lg bg-{{ $color }}-600 hover:bg-{{ $color }}-500">
        {{ $slot }}
    </button>
@endif


