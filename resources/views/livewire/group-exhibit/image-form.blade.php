<div>
    @if($showModal)
        <x-modal>
            {{-- Form --}}
            <x-form wire:submit.prevent="updateImage">
                @if ($action === 'hero')
                    <x-form.title>Edit Hero Image</x-form.title>
                @elseif ($action === 'logo')
                    <x-form.title>Edit Logo</x-form.title>
                @else
                    <x-form.title>Edit Poster Image</x-form.title>
                @endif

                {{-- Image Preview --}}
                <div class="flex border-2 justify-center items-center bg-white h-full overflow-hidden" style="min-height: 280px">
                    {{-- Check if edited image is hero or poster or logo --}}
                    @if ($file && ($file->getClientOriginalExtension() === 'jpg' || $file->getClientOriginalExtension() === 'png' || $file->getClientOriginalExtension() === 'jpeg'))
                            <img class="w-full object-cover" src="{{ $file->temporaryUrl() }}" alt="ticaphub-group-image">
                    @else
                        @if ($action == 'hero')
                            @if (is_null($groupExhibit->hero_image))
                                <img class="opacity-10 w-60" src="https://media.istockphoto.com/vectors/photo-coming-soon-image-icon-vector-illustration-isolated-on-white-vector-id1193046541?k=6&m=1193046541&s=612x612&w=0&h=1p8PD2GfCfIOPx0UTPXW3UDWpoJ4D0yJVJJzdqMDdsY=" alt="ticaphub-group-image">
                            @else
                                <img class="w-full object-cover" src="{{ asset($groupExhibit->hero_image) }}" alt="ticaphub-group-image">
                            @endif
                        @elseif ($action === 'logo')
                            @if (is_null($groupExhibit->logo))
                                <img class="opacity-10 w-60" src="https://media.istockphoto.com/vectors/photo-coming-soon-image-icon-vector-illustration-isolated-on-white-vector-id1193046541?k=6&m=1193046541&s=612x612&w=0&h=1p8PD2GfCfIOPx0UTPXW3UDWpoJ4D0yJVJJzdqMDdsY=" alt="ticaphub-group-image">
                            @else
                                <img class="w-full object-cover" src="{{ asset($groupExhibit->logo) }}" alt="ticaphub-group-logo">
                            @endif
                        @else
                            @if (!is_null($groupExhibit->poster_image))
                                <img class="w-full object-cover" src="{{ asset($groupExhibit->poster_image) }}" alt="ticaphub-group-poster">
                            @else
                                <img class="opacity-10 w-60" src="https://media.istockphoto.com/vectors/photo-coming-soon-image-icon-vector-illustration-isolated-on-white-vector-id1193046541?k=6&m=1193046541&s=612x612&w=0&h=1p8PD2GfCfIOPx0UTPXW3UDWpoJ4D0yJVJJzdqMDdsY=" alt="ticaphub-group-image">
                            @endif
                        @endif
                    @endif
                </div>

                {{-- Remove Image --}}
                <div class="text-right">
                    <x-app.button color="red" wire:click.prevent="removeImage">
                        <i class="fa-solid fa-trash mr-1"></i>
                        Remove image
                    </x-app.button>
                </div>

                {{-- Spinner --}}
                <x-spinner wire:loading.flex wire:target="file">Updating...</x-spinner>

                {{-- Image --}}
                <x-form.form-control>
                    @if ($action == 'hero')
                        <x-form.label for="file">Hero Image</x-form.label>
                        <x-form.input-info>
                            <strong>Note:</strong>
                            For the hero image, you can upload your group photo. This hero image is like a cover photo in Facebook.
                        </x-form.input-info>
                    @elseif ($action === 'logo')
                        <x-form.label for="file">Logo</x-form.label>
                    @else
                        <x-form.label for="file">Poster Image</x-form.label>
                    @endif
                    <input type="file" wire:model="file" accept="image/*"/>
                    @error('file')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>


                <div class="text-right">
                    <x-app.button color="gray" wire:click.prevent="closeModal">Cancel</x-app.button>
                    <x-app.button color="blue" type="submit">Save changes</x-app.button>
                </div>
            </x-form>
        </x-modal>
    @endif
</div>
