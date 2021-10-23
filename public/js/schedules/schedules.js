$(document).ready(function() {
    // DELETE MODAL
    window.addEventListener('openDeleteModal', function() {
       $('#deleteSchedModal').addClass('flex');
       $('#deleteSchedModal').removeClass('hidden');
   });
   window.addEventListener('closeDeleteModal', function() {
       $('#deleteSchedModal').removeClass('flex');
       $('#deleteSchedModal').addClass('hidden');
   });
   // ALERTS
   Livewire.on('schedDeleted', function() {
       alert('Schedule has been successfully deleted.');
   });
   Livewire.on('schedUpdated', function() {
       alert('Schedule has been successfully updated.');
   });
});