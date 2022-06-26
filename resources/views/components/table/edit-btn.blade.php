@if ($type == 'link')
    <a {{ $attributes }}class="text-white rounded p-2 text-xs tracking-wide bg-blue-600 hover:bg-red-blue" >
        <i class="fa-solid fa-pen"></i>
        <span class="hidden tracking-wide lg:inline-block">Edit</span>
    </a>
@else
    <button type="button" {{ $attributes }} class="text-white rounded p-2 text-xs tracking-wide bg-blue-600 hover:bg-red-blue" >
        <i class="fa-solid fa-pen"></i>
        <span class="hidden tracking-wide lg:inline-block">Edit</span>
    </button>
@endif



