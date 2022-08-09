@props([
    'type' => 'button',
    'color'
])

@if ($type === 'link')
    @if ($color === 'gray')
        <a {{ $attributes->merge(['type' => $type, 'class' => 'cursor-pointer py-2 px-4 text-sm rounded-lg text-black drop-shadow-lg bg-' . $color . '-100 hover:bg-' . $color . '-200']) }}>
            {{ $slot }}
        </a>
    @else
        <a {{ $attributes->merge(['class' => 'inline-block cursor-pointer py-2 px-4 text-sm text-white rounded-lg bg-' . $color . '-600 hover:bg-' . $color . '-500']) }}>
            {{ $slot }}
        </a>
    @endif
@else
{{-- Button for "Cancel" --}}
    @if ($color === 'gray')
        <button {{ $attributes->merge(['type' => $type, 'class' => 'py-2 px-4 text-sm rounded-lg text-black drop-shadow-lg bg-' . $color . '-100 hover:bg-' . $color . '-200']) }}>
            {{ $slot }}
        </button>
    @else
        <button {{ $attributes->merge(['type' => $type, 'class' => 'py-2 px-4 text-sm text-white rounded-lg bg-' . $color . '-600 hover:bg-' . $color . '-500']) }}>
            {{ $slot }}
        </button>
    @endif
@endif



