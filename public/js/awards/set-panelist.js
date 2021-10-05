$(document).ready(function() {
    // DELETE MODAL
    window.addEventListener('openDeleteModal', function() {
        $('#deletePanelistModal').addClass('flex');
        $('#deletePanelistModal').removeClass('hidden');
    });
    window.addEventListener('closeDeleteModal', function() {
        $('#deletePanelistModal').removeClass('flex');
        $('#deletePanelistModal').addClass('hidden');
    });
    // ALERTS
    Livewire.on('panelistDeleted', function() {
        alert('Panelist successfully deleted.');
    });

});