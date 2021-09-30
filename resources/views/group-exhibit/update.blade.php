<x-app-layout>
    <x-page-title>
        {{ $title }}
    </x-page-title>
    <h1 class="font-semibold text-2xl text-center">Update Exhibit</h1>
    <a href="/group-exhibit" class="inline-block bg-red-500 text-white hover:bg-red-600 rounded px-2 py-1">Back</a>
    <div class="w-1/3 shadow rounded mx-auto px-4 py-2">
        <form 
            action="/group-exhibit/{{ $group->id }}/update" 
            method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label class="block font-semibold mb-1">Project Title</label>
                <input type="text" name="title" class="rounded w-full" value='{{ $group->groupExhibit->title }}'>
                @error('title')
                <span class="bg-red-500 text-white block px-2 py-1 rounded mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="block font-semibold mb-1">Project Description</label>
                <input type="text" name="description" class="rounded w-full" value='{{ $group->groupExhibit->description }}'>
                @error('description')
                <span class="bg-red-500 text-white block px-2 py-1 rounded mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="block font-semibold mb-1">Banner</label>
                <input type="file" name="banner" class="rounded w-full" value='{{ $group->groupExhibit->banner_path }}'>
                @error('banner')
                <span class="bg-red-500 text-white block px-2 py-1 rounded mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="block font-semibold mb-1">Video</label>
                <input type="file" name="video" class="rounded w-full" value='{{ $group->groupExhibit->video_path }}'>
                @error('video')
                <span class="bg-red-500 text-white block px-2 py-1 rounded mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-500 text-white rounded px-2 py-1">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>