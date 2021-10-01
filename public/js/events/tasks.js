$(document).ready(function() {
    // DELETE MODAL
    window.addEventListener('openDeleteModal', function() {
        $('#deleteTaskModal').addClass('flex');
        $('#deleteTaskModal').removeClass('hidden');
    });
    window.addEventListener('closeDeleteModal', function() {
        $('#deleteTaskModal').removeClass('flex');
        $('#deleteTaskModal').addClass('hidden');
    });
    // FORM MODAL
    window.addEventListener('openFormModal', function() {
        $('#taskFormModal').addClass('flex');
        $('#taskFormModal').removeClass('hidden');
    });
    window.addEventListener('closeFormModal', function() {
        $('#taskFormModal').removeClass('flex');
        $('#taskFormModal').addClass('hidden');
    });
    // ALERTS
    Livewire.on('taskDeleted', function() {
        alert('Task successfully deleted.');
    });
    Livewire.on('taskUpdated', function() {
        alert('Position successfully updated.');
    });
});