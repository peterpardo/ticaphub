$(document).ready(function() {
    // UPDATE MODAL
    window.addEventListener('closeConfModal', function() {
        $('#confirmationModal').addClass('hidden');
        $('#confirmationModal').removeClass('flex');
    });
    window.addEventListener('openConfModal', function() {
        $('#confirmationModal').removeClass('hidden');
        $('#confirmationModal').addClass('flex');
    });
    // UPDATE MODAL
    window.addEventListener('closeUpdateModal', function() {
        $('#updateSpecModal').addClass('hidden');
        $('#updateSpecModal').removeClass('flex');
    });
    window.addEventListener('openUpdateModal', function() {
        $('#updateSpecModal').removeClass('hidden');
        $('#updateSpecModal').addClass('flex');
    });
    // DELETE MODAL
    window.addEventListener('openDeleteModal', function() {
        $('#deleteSpecModal').addClass('flex');
        $('#deleteSpecModal').removeClass('hidden');
    });
    window.addEventListener('closeDeleteModal', function() {
        $('#deleteSpecModal').removeClass('flex');
        $('#deleteSpecModal').addClass('hidden');
    });
    // ALERTS
    Livewire.on('specUpdated', function() {
        alert('Specialization successfully updated.');
    })
    Livewire.on('specDeleted', function() {
        alert('Specialization successfully deleted.');
    })
});