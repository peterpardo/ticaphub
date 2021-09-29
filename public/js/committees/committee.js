$(document).ready(function() {
    // DELETE MODAL
    window.addEventListener('openDeleteModal', function() {
        $('#deleteCommitteeModal').addClass('flex');
        $('#deleteCommitteeModal').removeClass('hidden');
    });
    window.addEventListener('closeDeleteModal', function() {
        $('#deleteCommitteeModal').removeClass('flex');
        $('#deleteCommitteeModal').addClass('hidden');
    });
    // UPDATE MODAL
    window.addEventListener('openUpdateModal', function() {
        $('#updateCommitteeModal').addClass('flex');
        $('#updateCommitteeModal').removeClass('hidden');
    });
    window.addEventListener('closeUpdateModal', function() {
        $('#updateCommitteeModal').removeClass('flex');
        $('#updateCommitteeModal').addClass('hidden');
    });
    // ALERTS
    Livewire.on('committeeDeleted', function() {
        alert('Committee successfully deleted.');
    });
    Livewire.on('committeeUpdated', function() {
        alert('Committee successfully updated.');
    });
});