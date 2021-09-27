$(document).ready(function () {
    // DELETE MODAL
    window.addEventListener('openDeleteModal', function() {
        $('#deletePositionModal').addClass('flex');
        $('#deletePositionModal').removeClass('hidden');
    });
    window.addEventListener('closeDeleteModal', function() {
        $('#deletePositionModal').removeClass('flex');
        $('#deletePositionModal').addClass('hidden');
    });
    // UPDATE MODAL
    window.addEventListener('openUpdateModal', function() {
        $('#updatePositionModal').addClass('flex');
        $('#updatePositionModal').removeClass('hidden');
    });
    window.addEventListener('closeUpdateModal', function() {
        $('#updatePositionModal').removeClass('flex');
        $('#updatePositionModal').addClass('hidden');
    });
    // ALERTS
    Livewire.on('positionDeleted', function() {
        alert('Position successfully deleted.');
    });
    Livewire.on('positionUpdated', function() {
        alert('Position successfully updated.');
    });
});