$(document).ready(function () {
    Livewire.on('profileUpdated', () => {
        location.reload();
        alert('Profile updated');
    });
});