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
                    <div class="bg-gray-100 rounded py-4 text-center block">No Title Inserted</div>
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
                    <div class="bg-gray-100 rounded py-4 text-center block">No Description Inserted</div>
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
                <div class="bg-gray-100 rounded py-4 text-center block">No Banner Uploaded</div>
            @endif
            @if($updateBanner)
                <input type="file" wire:model="banner" class="rounded mt-2 block">
                <span wire:loading wire:target="banner" class="text-green-500">Uploading...</span>
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
                <div class="bg-gray-100 rounded py-4 text-center block">No Video Uploaded</div>
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
                <div class="flex justify-end">
                    <button wire:click="updateVideo" class="bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1 mt-2">Edit Video</button>
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
            <div>
                <h1 class="font-bold text-lg mb-2">Project Adviser</h1>
                @if($updateAdviser)
                    <input type="text" wire:model="adviser" class="rounded w-full block">
                    <div class="flex justify-end">
                        <button wire:click="closeAdviser" class="border hover:bg-gray-300 rounded px-2 py-1 mt-2 mr-3">Cancel</button>
                        <button wire:click="saveAdviser" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mt-2">Save</button>
                    </div>
                @else
                    @if($group->adviser)
                    <div class="border rounded px-2 py-2">{{ $group->adviser }}</div>
                    @else
                        <div class="bg-gray-100 rounded py-4 text-center block">No Adviser Set</div>
                    @endif
                    @if(!$ticap->awards_is_set)
                        <div class="flex justify-end">
                            <button wire:click="updateAdviser" class="bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1 mt-2">Edit Adviser</button>
                        </div>
                    @endif
                @endif
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

        <div class="shadow-lg px-4 py-2 rounded-lg mb-4">
            <div class="mb-2">
                <h1 class="font-bold text-lg mb-2">Livestream Link</h1>
                @if($updateLink)
                    <textarea wire:model="link" class="w-full resize-none rounded"></textarea>
                    <div class="flex justify-end">
                        <button wire:click="closeLink" class="border hover:bg-gray-300 rounded px-2 py-1 mt-2 mr-3">Cancel</button>
                        <button wire:click="saveLink" class="bg-green-500 hover:bg-green-600 rounded text-white px-2 py-1 mt-2">Save</button>
                    </div>
                @else
                    @if($group->groupExhibit->link)
                        <p>{{ $group->groupExhibit->link }}</p>
                        <div class="fb-video" data-href="{{ $group->groupExhibit->link }}" data-width="500" data-show-text="false"></div>
                    @else
                        <div class="bg-gray-100 rounded py-4 text-center block">No Link Inserted</div>
                    @endif
                    <div class="flex justify-end">
                        <button wire:click="updateLink" class="bg-blue-500 hover:bg-blue-600 rounded text-white px-2 py-1 mt-2">Edit Link</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="shadow-lg px-4 py-2 rounded-lg mb-4">
            <h1 class="font-bold text-lg mb-2">Files</h1>
            <input type="file" wire:model="uploadedFiles" class="border mb-2" id="uploadedFiles" multiple>
            @if($uploadedFiles)
                <button wire:click="upload" class="bg-green-500 hover:bg-green-600 text-white rounded px-2 py-1 mb-2">Upload</button>
                <button wire:click="cancelUpload" class="shadow hover:bg-gray-100 rounded px-2 py-1 mb-2">Cancel</button>
            @endif
            @error('uploadedFiles.*')
                <span class="bg-red-500 text-white block px-2 py-1 rounded mb-2">{{ $message }}</span>
            @enderror
            @if(session('fileMsg'))
                <span class="bg-green-500 text-white block px-2 py-1 rounded mb-2">{{ session('fileMsg') }}</span>
            @endif
            <span wire:loading wire:target="uploadedFiles" class="text-green-500">Uploading...</span>
            @if($files->count() == 0) 
                <div class="bg-gray-100 rounded py-4 text-center block">No Files Uploaded</div>
            @else
                <table class="w-full text-center">
                    <thead>
                        <tr>
                            <td class="border bg-gray-100">Name</td>
                            <td class="border bg-gray-100">Created at</td>
                            <td class="border bg-gray-100">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                        <tr>
                            <td class="border px-2 py-2">{{ $file->name }}</td>
                            <td class="border px-2 py-2">{{ $file->created_at->diffForHumans() }}</td>
                            <td class="border px-2 py-2">
                                <button wire:click="selectFile({{ $file->id }}, 'download')" class="rounded bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white">Download</button>
                                <button wire:click="selectFile({{ $file->id }}, 'delete')" class="rounded bg-red-500 hover:bg-red-600 px-2 py-1 text-white">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- DELETE POSITION MODAL --}}
    <div class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none" id="deleteFileModal">
        <div class="absolute bg-white opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div >
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                    <p class="text-sm text-gray-500 px-8">Do you really want to delete the file? This process cannot be undone.</p>
                </div>
                <!--footer-->
                <div class="p-3 mt-2 text-center space-x-4 md:block">
                    <button wire:click="closeDeleteModal" class="close-btn inline-block mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">Cancel</button>
                    <button wire:click="deleteFile" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE POSITION MODAL --}}
</div>
