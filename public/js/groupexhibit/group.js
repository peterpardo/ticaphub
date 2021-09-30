$(document).ready(function() {
     // UPDATE MODAL
     window.addEventListener('openUpdateModal', function() {
        $('#updateGroupModal').addClass('flex');
        $('#updateGroupModal').removeClass('hidden');
    });
    window.addEventListener('closeUpdateModal', function() {
        $('#updateGroupModal').removeClass('flex');
        $('#updateGroupModal').addClass('hidden');
    });
    // ALERTS
    Livewire.on('groupExhibitDeleted', function() {
        alert('Group Exhibit successfully deleted.');
    });
    Livewire.on('groupExhibitUpdated', function() {
        alert('Group Exhibit successfully updated.');
    });
});