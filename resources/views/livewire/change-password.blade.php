<div>
    @if ($showModal)
        <x-modal>
            {{-- Form --}}
            <x-form wire:submit.prevent="changePassword">
                <x-form.title>Change Password</x-form.title>
                <x-form.form-control>
                    <x-form.label for="oldPassword">Old Password</x-form.label>
                    <x-form.input-info><strong>Note:</strong> Enter your current password here</x-form.input-info>
                    <x-input type="password" wire:model="oldPassword" id="oldPassword" placeholder="Old Password"/>
                    @error('oldPassword')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                <x-form.form-control>
                    <x-form.label for="newPassword">New Password</x-form.label>
                    <x-form.input-info><strong>Note:</strong> Please enter a new password</x-form.input-info>
                    <x-form.input type="password" wire:model="newPassword" id="newPassword" placeholder="New Password" />
                    @error('newPassword')
                        <x-form.error>{{ $message }}</x-form.error>
                    @enderror
                </x-form.form-control>

                <x-form.form-control>
                    <x-form.label for="confirmPassword">Re-type New Password</x-form.label>
                    <x-form.input type="password" wire:model="confirmPassword" id="confirmPassword" placeholder="Re-type New Password" />
                    @error('confirmPassword')
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
