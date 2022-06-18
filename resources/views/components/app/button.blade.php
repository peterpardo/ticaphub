<button {{ $attributes->merge(['type' => 'button']) }} class="py-2 px-4 text-sm text-white rounded-lg bg-{{ $color }}-600 hover:bg-{{ $color }}-500">
    {{ $slot }}
</button>
