$(document).ready(function () {
    Livewire.on('profileUpdated', () => {
        alert('Profile updated');
    });
});