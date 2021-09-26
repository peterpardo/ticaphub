$(document).ready(function() {
    // ALERTS
    Livewire.on('userUpdated', () => {
        alert('User successfully updated.');
    })
    Livewire.on('userDeleted', () => {
        alert('User successfully deleted.');
    })
});