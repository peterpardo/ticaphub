<div class="flex w-full">
    <div class="flex-1 shadow-lg mr-2 px-4 py-2">
        {{-- <button wire:click="openUpdateModal({{ $group->id }})" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mb-4">Update Exihibit</button> --}}
        <div>
            <h1 class="font-bold text-lg mb-2">Project Title</h1>
            @if($updateTitle)
                <input type="text" wire:model="title" class="rounded w-full block">
                <div class="flex justify-end">
                    <button wire:click="closeTitle" class="border hover:bg-gray-300 rounded px-2 py-1 mt-2 mr-3">Cancel</button>
                    <button wire:click="saveTitle" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mt-2">Save</button>
                </div>
            @else
                @if($group->groupExhibit->title)
                <div class="border rounded px-2 py-2">{{ $group->groupExhibit->title }}</div>
                @else
                <div class="bg-gray-500 text-white px-2 py-1 rounded">No input displayed on exhibit</div>
                @endif
                <div class="flex justify-end">
                    <button wire:click="updateTitle" class="bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1 mt-2">Edit Title</button>
                </div>
            @endif
        </div>
        <div>
            <h1 class="font-bold text-lg mb-2">Project Description</h1>
            @if($updateDesc)
                <textarea wire:model="desc" class="w-full resize-none rounded"></textarea>
                <div class="flex justify-end">
                    <button wire:click="closeDesc" class="border hover:bg-gray-300 rounded px-2 py-1 mt-2 mr-3">Cancel</button>
                    <button wire:click="saveDesc" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mt-2">Save</button>
                </div>
            @else
                @if($group->groupExhibit->description)
                <div class="border rounded px-2 py-2">{{ $group->groupExhibit->description }}</div>
                @else
                <div class="bg-gray-500 text-white px-2 py-1 rounded">No input displayed on exhibit</div>
                @endif
                <div class="flex justify-end">
                    <button wire:click="updateDesc" class="bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1 mt-2">Edit Description</button>
                </div>
            @endif
        </div>
        <div>
            <h1 class="font-bold text-lg mb-2">Banner Image</h1>
            @if($currentBanner)
            <img src="{{ Storage::url($currentBanner) }}">
            @elseif($banner)
            <img src="{{ $banner->temporaryUrl() }}">
            @else
            <div class="bg-gray-500 text-white px-2 py-1 rounded">No input displayed on exhibit</div>
            @endif
            @if($updateBanner)
                <input type="file" wire:model="banner" class="rounded mt-2">
                <div class="flex justify-end">
                    <button wire:click="closeBanner" class="border hover:bg-gray-300 rounded px-2 py-1 mt-2 mr-3">Cancel</button>
                    <button wire:click="saveBanner" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mt-2">Save</button>
                </div>
                @error('banner')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
            @else
                <div class="flex justify-end">
                    <button wire:click="updateBanner" class="bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1 mt-2">Edit Banner</button>
                </div>
            @endif
        </div>
        <div>
            <h1 class="font-bold text-lg mb-2">Project Video</h1>
            @if($currentVideo)
            <video class="w-full" controls loop autoplay muted>
                <source src="{{ Storage::url($currentVideo) }}">
            </video>
            @elseif($video)
            <video class="w-full" controls loop autoplay muted>
                <source src="{{ $video->temporaryUrl() }}">
            </video>
            @else
            <div class="bg-gray-500 text-white px-2 py-1 rounded">No input displayed on exhibit</div>
            @endif
            @if($updateVideo)
                <input type="file" wire:model="video" class="rounded mt-2 block">
                <span wire:loading wire:target="video" class="text-green-500">Uploading...</span>
                @error('video')
                <span class="bg-red-500 px-2 py-1 rounded text-white block my-2">{{ $message }}</span>
                @enderror
                <div class="flex justify-end">
                    <button wire:click="closeVideo" class="border hover:bg-gray-300 rounded px-2 py-1 mt-2 mr-3">Cancel</button>
                    <button wire:click="saveVideo" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mt-2">Save</button>
                </div>
            @else
                {{-- @if($group->groupExhibit->video_path)
                <div class="border rounded px-2 py-1">{{ $group->groupExhibit->video_path }}</div>
                @else
                <div class="bg-gray-500 text-white px-2 py-1 rounded">No input displayed on exhibit</div>
                @endif --}}
                <div class="flex justify-end">
                    <button wire:click="updateVideo" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mt-2">Edit Video</button>
                </div>
            @endif
        </div>
    </div>
    <div class="flex-1 ml-2">
        <div class="shadow-lg px-4 py-2 rounded-lg mb-4">
            <div class="mb-2">
                <h1 class="font-bold text-lg">Group Details</h1>
                <ul>
                    <li class="my-1">{{ $group->specialization->school->name }}</li>
                    <li class="my-1">{{ $group->specialization->name }}</li>
                </ul>
            </div>
            <div class="mb-2">
                <h1 class="font-bold text-lg">Members</h1>
                <ul>
                    @foreach($group->userGroups as $userGroup)
                    <li class="my-1">{{ $userGroup->user->first_name . ' ' . $userGroup->user->middle_name . ' ' . $userGroup->user->last_name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- <div class="shadow-lg px-4 py-2 rounded-lg mb-4">
            <h1 class="font-bold text-lg mb-2">Files</h1>
        </div> --}}
    </div>
    
    {{-- UPDATE GROUP MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="updateGroupModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <div >
                @livewire('group-exhibit-form')
            </div>
        </div>
    </div>
    {{-- UPDATE GROUP MODAL --}}
</div>
