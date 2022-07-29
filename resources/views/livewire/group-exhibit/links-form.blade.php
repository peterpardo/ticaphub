<div>
    @if ($showModal)
        <x-modal>
            <x-form wire:submit.prevent="updateLinks">
                <x-form.title>Edit Social Media Links</x-form.title>

                {{-- Note --}}
                <x-info-box color="yellow">
                    If your group has a social media account, you can add it here for the guests to visit but it's not required.
                </x-info-box>

                {{-- Facebook --}}
                <x-form.form-control>
                    <x-form.label for="fb">Facebook</x-form.label>
                    <x-form.input-info>
                        In here, type in the facebook page of your group.
                    </x-form.input-info>
                    <x-form.input wire:model.lazy="fb" id="fb" />
                    @error('fb')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Youtube --}}
                <x-form.form-control>
                    <x-form.label for="yt">Youtube</x-form.label>
                    <x-form.input-info>
                        In here, type in the youtube channel of your group.
                    </x-form.input-info>
                    <x-form.input wire:model.lazy="yt" id="yt" />
                    @error('yt')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Instagram --}}
                <x-form.form-control>
                    <x-form.label for="ig">Instagram</x-form.label>
                    <x-form.input-info>
                        In here, type in the instagram link of your group.
                    </x-form.input-info>
                    <x-form.input wire:model.lazy="ig" id="ig" />
                    @error('ig')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                {{-- Twitter --}}
                <x-form.form-control>
                    <x-form.label for="tt">Twitter</x-form.label>
                    <x-form.input-info>
                        In here, type in the twitter link of your group.
                    </x-form.input-info>
                    <x-form.input wire:model.lazy="tt" id="tt" />
                    @error('tt')
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
