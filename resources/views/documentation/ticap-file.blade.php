<x-app-layout>
    <h1 class="font-bold text-3xl my-3">{{ $title }}</h1>
    <div>
        <h1 class="font-semibold text-3xl my-2">Event Files</h1>
        @foreach ($ticap->events as $event)
        <div>
            <div class="text-xl font-semibold">{{ $event->name }}</div>
            <ul class="list-inside list-disc">
                @foreach ($event->files as $file)
                <li>
                <a href="/event-files/{{ $file->path }}" class="text-blue-500 hover:text-blue-600 underline">
                    {{ $file->name }}
                </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</x-app-layout>