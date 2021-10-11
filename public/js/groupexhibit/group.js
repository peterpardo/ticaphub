$(document).ready(function() {
     // DELETE MODAL
     window.addEventListener('openDeleteModal', function() {
        $('#deleteFileModal').addClass('flex');
        $('#deleteFileModal').removeClass('hidden');
    });
    window.addEventListener('closeDeleteModal', function() {
        $('#deleteFileModal').removeClass('flex');
        $('#deleteFileModal').addClass('hidden');
    });
    //  RESET FILE INPUT
    Livewire.on('resetFileUpload', function() {
        const files = document.getElementById('uploadedFiles');
        files.value = "";
    });
    // ALERTS
    Livewire.on('groupExhibitDeleted', function() {
        alert('Group Exhibit successfully deleted.');
    });
    Livewire.on('groupExhibitUpdated', function() {
        alert('Group Exhibit successfully updated.');
    });
    Livewire.on('reloadPage', function() {
        location.reload();
    });
});