@props(['status', 'color' => 'green'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-' . $color . '-600']) }}>
        {{ $status }}
    </div>
@endif

